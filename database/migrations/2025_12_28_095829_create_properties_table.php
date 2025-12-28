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
        Schema::create('propertys', function (Blueprint $table) {
            $table->id();
            $table->string('property_Location');
            $table->string('property_house_Number');
            $table->string('property_plan_Number');
            $table->string('property_remarks');
            $table->string('property_sketch_image');
            $table->string('property_North');
            $table->string('property_South');
            $table->string('property_East');
            $table->string('property_West');
            $table->string('property_Parcel_Number');
            $table->string('property_Code_Number');
            // foreign key
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
                ->references('id')
                ->on('persons');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->unsignedBigInteger('block_id');
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertys');
    }
};
