<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\SchoolType\Models\SchoolType;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('school_types', function (Blueprint $table) {
      $table->id();
      $table->string('title')->unique();
      $table->boolean('status');
      $table->timestamps();
    });

    $schoolTypes = [
      [
        'title' => 'دولتی',
        'status' => 1,
      ],
      [
        'title' => 'غیر انتفاعی',
        'status' => 1,
      ],
      [
        'title' => 'استثناعی',
        'status' => 1,
      ],
    ];

    foreach ($schoolTypes as $schoolType) {
      SchoolType::query()->create($schoolType);
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('school_types');
  }
};
