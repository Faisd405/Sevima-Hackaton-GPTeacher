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
        Schema::create('curriculum_material_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('curriculum_material_id');

            $table->string('content');

            $table->timestamps();

            $table->foreign('curriculum_id')->references('id')->on('curriculums');
            $table->foreign('curriculum_material_id')->references('id')->on('curriculum_materials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_material_details');
    }
};
