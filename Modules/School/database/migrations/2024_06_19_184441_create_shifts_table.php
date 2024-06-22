<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\School\Models\Shift;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('shifts', function (Blueprint $table) {
			$table->id();
			$table->string('title')->unique();
			$table->boolean('status');
			$table->timestamps();
		});

		$shifts = [
			[
				'title' => 'شیفت صبح',
				'status' => 1,
			],
			[
				'title' => 'شیفت بعد از ظهر',
				'status' => 1,
			],
			[
				'title' => 'گردشی',
				'status' => 1,
			],
		];

		foreach ($shifts as $shift) {
			Shift::query()->create($shift);
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('shifts');
	}
};
