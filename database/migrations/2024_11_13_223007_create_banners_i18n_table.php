<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id')->comment('ID на банера');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на банера');
            $table->json('keywords')->nullable()->comment('Ключови думи на банера');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_i18n', function (Blueprint $table) {
            $table->dropForeign(['banner_id']);
            $table->dropForeign(['language_id']);
        });
        
        Schema::dropIfExists('banners_i18n');
    }
};