<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на участието');
            $table->string('slug')->comment('Секретно име на участието');
            $table->unsignedBigInteger('area_id')->comment('ID на областта');
            $table->string('website')->nullable()->comment('Уебсайт на участието');
            $table->string('contact_email')->nullable()->comment('Имейл за контакт');
            $table->string('contact_phone_one')->nullable()->comment('Телефон за контакт 1');
            $table->string('contact_phone_two')->nullable()->comment('Телефон за контакт 2');
            $table->string('longitude')->nullable()->comment('Географска дължина');
            $table->string('latitude')->nullable()->comment('Географска ширина');
            $table->integer('position')->unsigned()->nullable()->default(0)->comment('Позиция на участието');
            $table->json('social_media_links')->nullable()->comment('Линкове към социалните мрежи');
            $table->json('working_hours')->nullable()->comment('Работно време');
            $table->dateTime('active_from')->nullable()->comment('Активно от');
            $table->dateTime('active_to')->nullable()->comment('Активно до');
            $table->boolean('active')->unsigned()->nullable()->default(1)->comment('Статус на участието');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participations', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('participations', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        
        Schema::dropIfExists('participations');
    }
};