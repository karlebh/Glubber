<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('drivers', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class);
      $table->integer('year');
      $table->string('model');
      $table->string('color');
      $table->string('plate_no');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('drivers');
  }
};
