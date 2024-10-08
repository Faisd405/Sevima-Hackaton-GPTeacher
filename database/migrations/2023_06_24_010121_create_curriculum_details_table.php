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
        Schema::create('curriculum_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('curriculum_id');

            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->foreign('curriculum_id')->references('id')->on('curriculums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_details');
    }
};
