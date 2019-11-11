<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stylist;

class LoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except(['login', 'auth']);
  }

  public function login(Request $request)
  {
    if (!auth()->attempt(request(['email', 'password']))) {
      return response()->json([
        'success' => false,
        'message' => 'The email or password you have entered is incorrect.'
      ]);
    }
    else {
      return response()->json([
        'success' => true,
        'role' => auth()->user()->role->role
      ]);
    }
  }

  public function auth()
  {
    // if (!Auth::check()) {
    //   return response()->json([
    //     'success' => false,
    //     'message' => 'The email or password you have entered is incorrect.'
    //   ]);
    // }
    // else {
    //   return response()->json([
    //     'success' => true,
    //   ]);
    // }

    Auth::check();
    return auth()->user()->role->role;
  }

  public function logout()
  {
      return Auth::logout();
  }
}
