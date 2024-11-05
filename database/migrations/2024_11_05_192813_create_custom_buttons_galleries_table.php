<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomButtonsGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_buttons_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('custom_button_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('custom_buttons_gallery', function (Blueprint $table) {
            $table->foreign('custom_button_id')->references('id')->on('custom_buttons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_buttons_gallery', function (Blueprint $table) {
            $table->dropForeign(['custom_button_id']);
        });
        
        Schema::dropIfExists('custom_buttons_gallery');
    }
};