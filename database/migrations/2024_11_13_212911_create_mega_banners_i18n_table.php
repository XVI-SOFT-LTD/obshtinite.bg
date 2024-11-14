<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMegaBannersI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mega_banners_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mega_banner_id')->comment('ID на mega banera');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на мега банера');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('mega_banner_id')->references('id')->on('mega_banners')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mega_banners_i18n', function (Blueprint $table) {
            $table->dropForeign(['mega_banner_id']);
            $table->dropForeign(['language_id']);
        });

        Schema::dropIfExists('mega_banners_i18n');
    }
};