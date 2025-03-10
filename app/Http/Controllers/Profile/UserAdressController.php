<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdressRequest;
use App\Http\Resources\UserAdressResource;
use App\Services\UserAddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserAdressController extends Controller
{
    public $useradressservices;
    public function __construct(UserAddressService $useradressservices)
    {
        $this->useradressservices = $useradressservices;
    }
 public function show()
 {
    $userId = Auth::id();
    
    $user = Cache::remember("user_profile_{$userId}", 60, function () use ($userId) {
        return Auth::user()->Adress;
    });

    return response()->json(new UserAdressResource($user));
 }
 
 public function update(UserAdressRequest $request)
 {
    $userId = Auth::id();
        
    // Cache'ni tozalash
    Cache::forget("user_profile_{$userId}");

    $adress = $this->useradressservices->adressupdate($request);

    // Yangi ma'lumotlarni cache'ga joylash
    Cache::put("user_profile_{$userId}", $adress, 600);

    return response()->json(new UserAdressResource($adress));
 }
}
