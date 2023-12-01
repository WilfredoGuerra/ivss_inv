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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('serial');
            $table->string('asset_number');

            $table->foreignId('categories_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('brands_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('departments_id')->constrained('departments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('locations_id')->constrained('locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('states_id')->constrained('states')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
