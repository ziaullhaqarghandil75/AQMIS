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
        Schema::create('property_values', function (Blueprint $table) {
            $table->id();
            $table->float('Number_of_Floors')->nullable();
            $table->float('Scale');
            // foreign keys
            $table->unsignedBigInteger('emarat_type_id');
            $table->foreign('emarat_type_id')
                ->references('id')
                ->on('emarat_types');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties');
            $table->unsignedBigInteger('land_categories_id')->nullable();
            $table->foreign('land_categories_id')
                ->references('id')
                ->on('land_categories');
            $table->unsignedBigInteger('building_category_id')->nullable();
            $table->foreign('building_category_id')
                ->references('id')
                ->on('building_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_values');
    }
};
