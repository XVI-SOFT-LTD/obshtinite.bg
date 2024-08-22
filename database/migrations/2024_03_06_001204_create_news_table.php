<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('author_id')->unsigned()->nullable()->default(null)->comment('Автор');

            $table->string('slug', 250)->nullable(true);
            $table->string('logo', 250)->nullable(true)->comment('Главна снимка');

            $table->datetime('publish_date')->nullable(true)->comment('Дата на публикуване');

            $table->boolean('top')->unsigned()->nullable()->default(0);
            $table->boolean('active')->unsigned()->nullable()->default(0);

            $table->integer('views')->unsigned()->nullable()->default(0)->comment('Общо прегледи');
            $table->integer('views_day')->unsigned()->nullable()->default(0)->comment('Прегледи за ден');
            $table->integer('views_week')->unsigned()->nullable()->default(0)->comment('Прегледи за седмица');
            $table->integer('views_month')->unsigned()->nullable()->default(0)->comment('Прегледи за месец');
            $table->integer('views_year')->unsigned()->nullable()->default(0)->comment('Прегледи за година');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news_i18n', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('news_id')->nullable(true);
            $table->unsignedBigInteger('language_id')->unsigned()->nullable(true);

            $table->string('title', 500)->nullable(true)->comment('Заглавие');
            $table->text('description')->nullable(true)->comment('Описание');
            $table->text('tags')->nullable(true)->comment('Тагове');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('author_id')->references('id')->on('authors');
        });

        Schema::table('news_i18n', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news');
            $table->foreign('language_id')->references('id')->on('languages');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_i18n');
        Schema::dropIfExists('news');
    }
};
