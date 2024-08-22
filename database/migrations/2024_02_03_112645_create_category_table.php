<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->integer('parent_id')->unsigned()->default(0);

            $table->boolean('active')->unsigned()->nullable()->default(1);

            $table->integer('views')->unsigned()->nullable()->default(0)->comment('Общо прегледи');
            $table->integer('views_day')->unsigned()->nullable()->default(0)->comment('Прегледи за ден');
            $table->integer('views_week')->unsigned()->nullable()->default(0)->comment('Прегледи за седмица');
            $table->integer('views_month')->unsigned()->nullable()->default(0)->comment('Прегледи за месец');
            $table->integer('views_year')->unsigned()->nullable()->default(0)->comment('Прегледи за година');

            $table->string('slug', 250)->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categories_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->unsignedBigInteger('language_id')->unsigned()->nullable(true);
            $table->string('name', 250);
            $table->text('description')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::table('categories_i18n', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_i18n');
        Schema::dropIfExists('categories');
    }
};
