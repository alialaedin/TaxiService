<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\EducationLevel\Models\EducationLevel;
use Modules\Shift\Models\Shift;
use Modules\SchoolType\Models\SchoolType;
use Modules\Area\Models\City;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('schools', function (Blueprint $table) {
      $table->id();
      $table->string('title', 100);
      $table->string('telephone', 20);
      $table->string('manager_name', 100)->nullable();
      $table->string('manager_mobile', 20)->nullable();
      $table->foreignIdFor(EducationLevel::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(Shift::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(SchoolType::class)->constrained()->cascadeOnDelete();
      $table->boolean('status');
      $table->text('address');
      $table->text('map');
      $table->boolean('is_traffic');
      $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('schools');
  }
};
