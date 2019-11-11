<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\User;

class AppointmentController extends Controller
{
  public function index()
  {
    $first = Auth::user()->first;
    User::where('first', $first)->get();
    $id = auth()->id();
    return Appointment::where('user_id', $id)->get();
  }
  public function appointments()
  {
    $salon_id = auth()->user()->salon_id;
    $user_id = User::where('salon_id', $salon_id)->pluck('id');
    return Appointment::where('user_id', $user_id)->get();
  }
  public function store()
  {
    $this->validate(request(), [
    'date' => 'required',
    'time' => 'required',
    'user_id' => 'required',
    'service' => 'required',
    ]);

    return Appointment::create(request(['date', 'time', 'service', 'user_id', 'client_id']));
  }
  public function delete($id)
  {
      return ['success' => Appointment::find($id)->delete()];
  }
}
