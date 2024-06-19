<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Area\Models\City;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('companies', function (Blueprint $table) {
      $table->id();
      $table->string('title', 100)->unique();
      $table->string('name', 191);
      $table->string('mobile', 20)->unique();
      $table->string('telephone', 20)->unique();
      $table->text('address');
      $table->string('logo');
      $table->boolean('status');
      $table->string('username')->unique();
      $table->string('password');
      $table->string('account_number')->unique();
      $table->string('card_number')->unique();
      $table->string('sheba_number')->unique();
      $table->string('resume');
      $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('companies');
  }
};
