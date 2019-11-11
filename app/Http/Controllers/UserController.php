<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Role;
use App\Salon;

class UserController extends Controller
{
  public function users()
  {
    return Auth::user();
  }

  public function index()
  {
    $users = User::whereHas('role', function ($query) {
      $query->whereIn('role',  ['owner', 'independent']);
    })->get();

    $output = [];
    foreach($users as $user) {
      $user_array = $user->toArray();
      $user_array['role'] = $user->role->role;
      $user_array['salon'] = $user->salon->name;
      $output[] = $user_array;
    }

    return $output;
  }

  public function role()
  {
    return Role::whereIn('role', ['owner', 'independent'])->get();
  }

  public function store()
  {
    $this->validate(request(), [
      'name' => 'required',
      'role_id' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*\(\)]).*$/',
    ]);

    $salon = Salon::create(request(['name']));

    $user = new User(request(['email', 'password']));
    $user->salon_id = $salon->id;
    $user->role_id = request()->role_id;
    $user->save();


    return back();
  }

  public function update()
  {
    $this->validate(request(), [
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*\(\)]).*$/',
    ]);

    $id = auth()->user()->id;

    User::where('id', $id )
          ->update([
            'email' => request()->email,
            'password' => request()->password,
          ]);

  }

  public function stylists()
  {
    $salon_id = auth()->user()->salon_id;
    return User::whereIn('role_id', ['3', '4'])->where('salon_id', $salon_id)->get();
  }

  public function stylist()
  {
    return auth()->user();
  }

  public function storestylist()
  {
    $this->validate(request(), [
      'first' => 'required',
      'last' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%^&*\(\)]).*$/',
    ]);

    $user = new User(request(['email', 'password']));
    $user->salon_id = auth()->user()->salon_id;
    $user->role_id = '4';
    $user->first = request()->first;
    $user->last = request()->last;
    $user->save();
  }
}
