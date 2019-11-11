<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Hair;

class HairController extends Controller
{
  public function index()
  {
      return Hair::all();
  }
  public function show($id)
  {
      return Hair::where('client_id', $id)->first();
  }
  public function store()
  {
      return Hair::create(Input::all());
  }
}
