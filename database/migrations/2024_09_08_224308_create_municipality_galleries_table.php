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
        Schema::create('municipality_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('municipality_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('municipality_gallery', function (Blueprint $table) {
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipality_gallery', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
        });
        
        Schema::dropIfExists('municipality_gallery');
    }
};