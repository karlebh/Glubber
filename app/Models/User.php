<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'login_code',
    'phone',
    'email',
    'password',
  ];

  protected $hidden = [
    'phone',
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  // public function routeNotificationForVonage($notification)
  // {
  //   return '+2347038520433';
  // }

  // public function routeNotificationForTwilio()
  // {
  //   return '+2347038520433';
  // }

  public function driver()
  {
    return $this->hasOne(Driver::class);
  }

  public function trips()
  {
    return $this->hasMany(Trip::class);
  }
}
