<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participations_gallery', function (Blueprint $table) {
             $table->id();

            $table->unsignedBigInteger('participation_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participations_gallery', function (Blueprint $table) {
            $table->foreign('participation_id')->references('id')->on('participations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participations_gallery', function (Blueprint $table) {
            $table->dropForeign(['participation_id']);
        });
        
        Schema::dropIfExists('participations_gallery');
    }
};