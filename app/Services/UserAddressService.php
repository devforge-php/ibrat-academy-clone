<?php 


namespace App\Services;

use App\Http\Requests\UserAdressRequest;
use Illuminate\Support\Facades\Auth;

class UserAddressService
{
  public function adressupdate(UserAdressRequest $reqest)
  {
    $adress = Auth::user()->Adress;

    if (!$adress) {
        throw new \Exception('Address topilmadi');
    }
    $adress->update([
        'country' => $reqest->country,
        'provice' => $reqest->provice,
        'district' => $reqest->district,
        'local_comunity' => $reqest->local_comunity,
    ]);
    return $adress; 
  }
}



?>