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
        Schema::create('land_categories', function (Blueprint $table) {
            $table->id();
            $table->string('land_Category_Name');
            $table->string('land_category_location');
            $table->float('land_category_unit_Price');
            // foreign key
            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')
                ->references('id')
                ->on('zones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_categories');
    }
};
