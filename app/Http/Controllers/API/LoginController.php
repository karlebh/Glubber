<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'phone' => 'required|numeric|min:11|max:13'
    ]);

    $user = User::create(['phone' => $request->phone]);

    if (!$user) {
      return response()->json(['message' => 'Wrong phone number'], 401);
    }

    $loginCode = rand(111_111, 999_999);
    $user->update(['login_code' => $loginCode]);

    Mail::to($user)->send(new AccountCreatedMail($loginCode));

    return response()->json(['message' => "Login code sent successfully."]);
  }

  public function verify(Request $request)
  {
    $request->validate([
      'phone' => 'required|numeric|min:11|max:13',
      'login_code' => 'required|numeric'
    ]);

    $user = User::where('phone', $request->phone)
      ->where('login_code', $request->login_code)
      ->first();

    if ($user->created_at->diffInMinutes(now()) > 10) {
      return response()->json(['message' => 'Time limit exceeded. Please log in with your phone number again.'], 401);
    }

    if (!$user) {
      return response()->json(['message' => 'Wrong phone number or login code'], 401);
    }

    $user->login_code = null;
    $token = $user->createToken($request->login_code)->plainTextToken;

    return response()->json(['token' => $token]);
  }
}
