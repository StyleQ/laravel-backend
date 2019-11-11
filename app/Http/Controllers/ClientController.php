<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\Appointment;

class ClientController extends Controller
{
  public function index()
  {
    $user = auth()->user()->salon_id;
    return Client::where('salon_id', $user)->get();
  }

  public function clients()
  {
    $id = auth()->user()->id;
    $client_id = Appointment::where('user_id', $id)->pluck('client_id');
    dd($client_id);
    return Client::where('id', $client_id)->get();

  }

  public function show($id)
  {
      return Client::find($id);
  }
  public function store()
  {
    $this->validate(request(), [
    'first' => 'required',
    'last' => 'required',
    'dob' => 'required',
    'phone' => 'required',
    'email' => 'required|email',
    'address' => 'required',
    ]);

    $user = auth()->user()->salon_id;
    $salon_id = $user;

    return Client::create(request(['first', 'last', 'dob', 'phone', 'email', 'address']) + ['salon_id' => $salon_id]);
  }
}
