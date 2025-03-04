<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\ProfileResourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Services\UserProfileServices;

class UserProfileController extends Controller
{
    public $userprofileservices;
    public function __construct(UserProfileServices $userprofileservices)
    {
        $this->userprofileservices = $userprofileservices;
    }
    public function show()
    {
        $userId = Auth::id();
    
        $user = Cache::remember("user_profile_{$userId}", 60, function () use ($userId) {
            return Auth::user()->profile;
        });
    
        return response()->json(new ProfileResourse($user));
    }
    public function update(UserProfileRequest $request)
    {   
        $userId = Auth::id();
        
        // Cache'ni tozalash
        Cache::forget("user_profile_{$userId}");

        $profile = $this->userprofileservices->profileupdate($request);

        // Yangi ma'lumotlarni cache'ga joylash
        Cache::put("user_profile_{$userId}", $profile, 600);

        return response()->json(new ProfileResourse($profile));
    }
}
