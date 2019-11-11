<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Makeup;

class MakeupController extends Controller
{
  public function index()
  {
      return \App\Makeup::all();
  }
  public function show($id)
  {
      return \App\Makeup::where('client_id', $id)->first();
  }
  public function store()
  {
      return \App\Makeup::create(Input::all());
  }
}
