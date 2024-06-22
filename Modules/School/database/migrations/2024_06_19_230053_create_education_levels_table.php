<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\School\Models\EducationLevel;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('education_levels', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->enum('gender', ['male', 'female']);
      $table->boolean('status');
      $table->timestamps();
    });

    $educationLevels = [
      [
        'title' => 'متوسطه اول',
        'status' => 1,
        'gender' => 'male',
      ],
      [
        'title' => 'متوسطه اول',
        'status' => 1,
        'gender' => 'female',
      ],
      [
        'title' => 'متوسطه دوم',
        'status' => 1,
        'gender' => 'male',
      ],
      [
        'title' => 'متوسطه دوم',
        'status' => 1,
        'gender' => 'female',
      ],
    ];

    foreach ($educationLevels as $educationLevel) {
      EducationLevel::query()->create($educationLevel);
    }

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('education_levels');
  }
};
