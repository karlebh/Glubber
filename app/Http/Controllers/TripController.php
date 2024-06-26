<?php

namespace App\Http\Controllers;

use App\Events\TripAccepted;
use App\Events\TripCreated;
use App\Events\TripEnded;
use App\Events\TripLocationUpdated;
use App\Events\TripStarted;
use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
  public function store(Request $request)
  {
    $data =  $request->validate([
      'origin' => 'required',
      'destination' => 'required',
      'destination_name' => 'required',
    ]);

    $trip = Trip::create(
      [
        ...$data,
        'user_id' => $request->user()->id,
      ]
    );

    event(new TripCreated($trip, $request->user()));

    return response()->json(['trip' => $trip, 'message' => 'Trip successfully created']);
  }

  public function show(Trip $trip, Request $request)
  {
    if (
      $trip->user->id === $request->user()->id
      || $trip->driver?->id === $request->user()?->driver->id
    ) {
      return response()->json(['trip' => $trip]);
    }

    return response()->json(['message' => 'Cannot find this trip'], 404);
  }

  public function accept(Request $request, Trip $trip)
  {
    $request->validate(['driver_location']);

    $trip->update([
      'driver_id' => $request->user()->id,
      'driver_location' => $request->driver_location
    ]);

    $trip = $trip->load('driver.user');

    event(new TripAccepted($trip, $trip->user));

    return response()->json(['message' => 'Trip accepted by driver', 'trip' => $trip]);
  }

  public function start(Request $request, Trip $trip)
  {
    $trip->update(['is_started' => true]);

    $trip = $trip->load('driver.user');

    event(new TripStarted($trip, $request->user()));

    return response()->json(['message' => 'Trip started by driver', 'trip' => $trip]);
  }

  public function end(Request $request, Trip $trip)
  {
    $trip->update(['is_completed' => true]);

    $trip = $trip->load('driver.user');

    event(new TripEnded($trip, $request->user()));

    return response()->json(['message' => 'Trip ended by driver', 'trip' => $trip]);
  }

  public function location(Request $request, Trip $trip)
  {
    $request->validate(['driver_location']);

    $trip->update([
      'driver_location' => $request->driver_location
    ]);

    $trip = $trip->load('driver.user');

    event(new TripLocationUpdated($trip, $request->user()));

    return response()->json(['message' => 'Trip location changed by driver', 'trip' => $trip]);
  }
}
