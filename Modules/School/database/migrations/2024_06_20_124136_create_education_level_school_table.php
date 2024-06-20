<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('education_level_school', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(\Modules\School\Models\School::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(\Modules\EducationLevel\Models\EducationLevel::class)->constrained()->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('education_level_school');
  }
};