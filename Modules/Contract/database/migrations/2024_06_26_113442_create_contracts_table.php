<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Models\Company;
use Modules\Contract\Models\Contract;
use Modules\School\Models\EducationLevel;
use Modules\Family\Models\Family;
use Modules\School\Models\School;
use Modules\School\Models\SchoolType;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('contracts', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(School::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(SchoolType::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(Family::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(EducationLevel::class)->constrained()->cascadeOnDelete();
      $table->longText('rules');
      $table->enum('gender', Contract::getAllGenders());
      $table->enum('service_type', Contract::getAllServices());
      $table->text('address')->nullable();
      $table->string('latitude');
      $table->string('longitude');
      $table->date('start_date')->nullable();
      $table->date('end_date')->nullable();
      $table->enum('status', Contract::getAllStatuses());
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('contracts');
  }
};
