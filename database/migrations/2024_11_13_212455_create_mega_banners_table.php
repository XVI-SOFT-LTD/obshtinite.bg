<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMegaBannersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mega_banners', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на Банера');
            $table->boolean('active')->unsigned()->nullable()->default(1)->comment('Статус на мега банера');
            $table->dateTime('active_from')->nullable()->comment('Активно от');
            $table->dateTime('active_to')->nullable()->comment('Активно до');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('mega_banners', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mega_banners', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('mega_banners');
    }
};