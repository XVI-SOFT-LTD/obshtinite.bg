<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTableI18n extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('landmarks_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('landmark_id')->comment('ID на забележителността');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на забележителността');
            $table->text('description')->nullable(false)->comment('Описание на забележителността');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('landmark_id')->references('id')->on('landmarks')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('landmarks_i18n', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['language_id']);
        });
        
        Schema::dropIfExists('landmarks_i18n');
    }
};