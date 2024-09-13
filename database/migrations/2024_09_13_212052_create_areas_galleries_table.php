<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('areas_gallery', function (Blueprint $table) {
             $table->id();

            $table->unsignedBigInteger('area_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('areas_gallery', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_gallery', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
        });
        
        Schema::dropIfExists('areas_gallery');
    }
};