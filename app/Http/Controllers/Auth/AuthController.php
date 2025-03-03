<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    // Emailga tasdiqlash kodi yuborish
    public function sendVerificationCode(AuthRequest $request)
    {
        $email = $request->input('email');
        $result = $this->authService->sendVerificationCode($email);

        if ($result['status'] === 'error') {
            return response()->json(['error' => $result['message']], $result['code']);
        }

        return response()->json(['message' => $result['message']]);
    }

    // Tasdiqlash kodini tekshirish va ro'yxatdan o'tish
    public function verifyCode(Request $request)
    {
        $code = $request->input('code');
        $result = $this->authService->verifyCode($code);

        if ($result['status'] === 'error') {
            return response()->json(['error' => $result['message']], $result['code']);
        }

        return response()->json([
            'message' => $result['message'],
            'user' => $result['user'],
            'token' => $result['token'],
        ]);
    }

    // Logout qilish
    public function logout(Request $request)
    {
        $result = $this->authService->logout($request->user());

        if ($result['status'] === 'error') {
            return response()->json(['error' => $result['message']], $result['code']);
        }

        return response()->json(['message' => $result['message']]);
    }
}