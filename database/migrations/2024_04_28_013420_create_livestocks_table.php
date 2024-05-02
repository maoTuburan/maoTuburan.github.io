<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('livestocks', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->string('farmer_barangay');
			$table->foreignUuid('farmer_name')->constrained('farmers')->onDelete('cascade');
			$table->string('livestock_species');
			$table->bigInteger('livestock_number');
			$table->bigInteger('age');
			$table->string('color');
			$table->string('insurance_or_renewal');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('livestocks');
	}
};
