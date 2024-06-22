<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Driver\Models\Driver;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('drivers', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(\Modules\Company\Models\Company::class)->constrained()->cascadeOnDelete();
      $table->enum('car_type', Driver::getAllCarTypes());
      $table->enum('gender', Driver::getAllGenders());
      $table->string('name');
      $table->string('license_image');
      $table->string('driver_image')->nullable();
      $table->string('mobile', 20)->unique();
      $table->string('national_code', 20)->unique();
      $table->text('address');
      $table->string('car_model');
      $table->string('car_color');
      $table->string('car_name');
      $table->string('plaque', 50);
      $table->date('license_expiration_date')->nullable();
      $table->string('bank_name', 100);
      $table->string('account_number', 50);
      $table->string('sheba_number', 50);
      $table->string('card_number', 20);
      $table->text('description')->nullable();
      $table->enum('status', Driver::getAllStatuses())->default(Driver::STATUS_PENDING);
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
