<?php

namespace App\Services;

use App\Events\AuthEvent;
use App\Jobs\AuthUserJobs;
use App\Jobs\EmailCodeJob;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthServices
{
    // Emailga tasdiqlash kodi yuborish
    public function sendVerificationCode($email)
    {
        // Rate limiting: Har bir email uchun 1 daqiqada 1 marta urinish
        if (Cache::has("code_request:$email")) {
            return [
                'status' => 'xato',
                'message' => 'code qaytadan yuborish uchun 1-daqiqa kuting',
                'code' => 429,
            ];
        }

        // Tasdiqlash kodi generatsiyasi
        $verificationCode = Str::random(6);

        // Kodni cache-ga saqlash (5 minutga)
        Cache::put("verification_code:$email", $verificationCode, now()->addMinutes(5));
        Cache::put("verification_code_email:$verificationCode", $email, now()->addMinutes(5));

     
        // Email yuborishni queue jobga o'tkazish
        dispatch(new EmailCodeJob($email, $verificationCode));

        // Rate limitni cache-ga saqlash
        Cache::put("code_request:$email", true, now()->addMinute());

        return [
            'status' => 'muvaffaqiyatli',
            'message' => 'emailga code yuborildi',
        ];
    }

    // Tasdiqlash kodini tekshirish va ro'yxatdan o'tish
    public function verifyCode($code)
    {
        // Cache-dan emailni topish
        $email = Cache::get("verification_code_email:$code");

        if (!$email || !Cache::has("verification_code:$email") || Cache::get("verification_code:$email") !== $code) {
            return [
                'status' => 'xato',
                'message' => 'Tasdiqlash kodi yaroqsiz',
                'code' => 400,
            ];
        }

        // Cache-dan kodni o'chirish
        Cache::forget("verification_code:$email");
        Cache::forget("verification_code_email:$code");

        // User mavjudligini tekshirish yoki yangi user yaratish
        $user = User::firstOrCreate(
            ['email' => $email],
            ['password' => bcrypt(Str::random(8))] 
        );

        // Token yaratish
        $token = $user->createToken('auth_token')->plainTextToken;
    AuthUserJobs::dispatch($user);
        return [
            'status' => 'muvaffaqiyatli',
            'message' => 'Tasdiqlash muvaffaqiyatli',
            'user' => $user,
            'token' => $token,
        ];
    }

    // Logout qilish
    public function logout($user)
    {
        $user->currentAccessToken()->delete();

        return [
            'status' => 'muvaffaqiyatli',
            'message' => 'Hisobdan muvaffaqiyatli chiqdi',
        ];
    }
}