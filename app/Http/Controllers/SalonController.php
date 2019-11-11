<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salon;

class SalonController extends Controller
{
  public function index(){

      return Salon::all();
  }

  public function update()
  {
    $this->validate(request(), [
        'address1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'phone' => 'required',
      ]);

    $salon_id = auth()->user()->salon_id;

    Salon::where('id', $salon_id )
          ->update([
            'logo' => request()->logo,
            'address1' => request()->address1,
            'address2' => request()->address2,
            'city' => request()->city,
            'state' => request()->state,
            'zip' => request()->zip,
            'phone' => request()->phone,
          ]);
  }
}
