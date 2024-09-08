<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalityI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('municipalities_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipality_id')->comment('ID на общината');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на общината');
            $table->text('description')->nullable()->comment('Описание на общината');
            $table->string('address')->nullable()->comment('Адрес на общината');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipalities_i18n', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['language_id']);
        });

        Schema::dropIfExists('municipalities_i18n');
    }
};