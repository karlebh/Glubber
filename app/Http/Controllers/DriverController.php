<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
  public function show(Request $request)
  {
    return $request->user()->load('driver');
  }

  public function store(Request $request)
  {
    $request->validate([
      'year' => 'required|numeric|between:1990,2024',
      'make' => 'required',
      'model' => 'required',
      'color' => 'required|alpha',
      'plate_no' => 'required',
      'name' => 'required'
    ]);

    $user = $request->user();

    $user->update($request->name);
    $user->driver()->updateOrCreate($request->except('name'));

    return $user->load('driver');
  }
}
