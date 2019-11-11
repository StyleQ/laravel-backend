<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Service;

class ServiceController extends Controller
{
  public function index()
  {
    $user = auth()->user()->salon_id;
    return Service::where('salon_id', $user)->get();
  }
  public function store()
  {
    $this->validate(request(), [
    'name' => 'required',
    'category' => 'required',
    'duration' => 'required',
    'price' => 'required',
    'description' => 'required',
    ]);

    $user = auth()->user();
    $salon_id = $user->salon_id;

    return Service::create(request(['name', 'category', 'duration', 'price', 'description']) + ['salon_id' => $salon_id]);
  }

  public function update($id)
  {
    $this->validate(request(), [
      'name' => 'required',
      'category' => 'required',
      'duration' => 'required',
      'price' => 'required',
      'description' => 'required',
      ]);

    Service::where('id', $id )
          ->update([
            'name' => request()->name,
            'category' => request()->category,
            'durtion' => request()->duration,
            'price' => request()->price,
            'description' => request()->description,
          ]);
  }

  public function delete($id)
  {
      return ['success' => Service::find($id)->delete()];
  }
}
