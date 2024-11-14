<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersAreasMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners_areas_municipalities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id')->onDelete('cascade')->comment('ID на банера');
            $table->unsignedBigInteger('area_id')->onDelete('cascade')->comment('ID на областта');
            $table->unsignedBigInteger('municipality_id')->nullable()->onDelete('cascade')->comment('ID на общината');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('banners_areas_municipalities', function (Blueprint $table) {
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_areas_municipalities', function (Blueprint $table) {
            $table->dropForeign(['banner_id']);
            $table->dropForeign(['area_id']);
            $table->dropForeign(['municipality_id']);
        });
        
        Schema::dropIfExists('banners_areas_municipalities');
    }
};