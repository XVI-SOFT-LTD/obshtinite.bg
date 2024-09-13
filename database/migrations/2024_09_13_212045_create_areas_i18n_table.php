<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('areas_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->comment('ID на областта');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на областта');
            $table->text('description')->nullable()->comment('Описание на областта');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_i18n', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropForeign(['language_id']);
        });
        
        Schema::dropIfExists('areas_i18n');
    }
};