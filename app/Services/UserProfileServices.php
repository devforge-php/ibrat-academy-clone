<?php
namespace App\Services;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileServices 
{
   public function profileupdate(UserProfileRequest $reqest)
   {
    $profile = Auth::user()->profile;

    if (!$profile) {
        throw new \Exception('Profil topilmadi');
    }
    $profile->update([
        'name' => $reqest->name,
        'last_name' => $reqest->last_name,
        'age' => $reqest->age,
        'gender' => $reqest->gender,
    ]);
    return $profile;

   }
}







?>