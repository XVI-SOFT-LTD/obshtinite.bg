<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participations_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participation_id')->comment('ID на участието');
            $table->unsignedBigInteger('language_id')->comment('ID на езика');
            $table->string('name')->comment('Име на участието');
            $table->text('description')->nullable()->comment('Описание на участието');
            $table->string('address')->nullable()->comment('Адрес на участието');
            $table->json('keywords')->nullable()->comment('Ключови думи на участието');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('participation_id')->references('id')->on('participations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participations_i18n', function (Blueprint $table) {
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['language_id']);
        });
        
        Schema::dropIfExists('participations_i18n');
    }
};