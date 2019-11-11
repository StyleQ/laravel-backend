<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Group;

class GroupController extends Controller
{
  public function index()
  {
    $user = auth()->user()->salon_id;
    return Group::where('salon_id', $user)->get();
  }
  public function store()
  {
    $this->validate(request(), [
    'name' => 'required',
    ]);

    $user = auth()->user();
    $salon_id = $user->salon_id;

    return Group::create(request(['name']) + ['salon_id' => $salon_id]);

  }
}
