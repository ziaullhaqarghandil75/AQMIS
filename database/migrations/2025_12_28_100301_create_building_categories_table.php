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
        Schema::create('building_categories', function (Blueprint $table) {
            $table->id();
            $table->string('building_Category_Type_Name');
            $table->string('building_Category_details');
            $table->string('building_Category_unit_type');
            $table->float('building_Category_unit_Price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_categories');
    }
};
