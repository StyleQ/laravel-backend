<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Trial;

class SignupController extends Controller
{
  public function index()
  {
      return \App\Trial::all();
  }
  public function store()
  {
      return \App\Trial::create(Input::all());
  }
}
