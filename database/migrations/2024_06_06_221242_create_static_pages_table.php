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
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->string('slug')->nullable(false);
            $table->string('picture', 255)->nullable();

            $table->boolean('active')->default(false)->comment('Активен');

            $table->integer('views')->unsigned()->nullable()->default(0)->comment('Общо прегледи');
            $table->integer('views_day')->unsigned()->nullable()->default(0)->comment('Прегледи за ден');
            $table->integer('views_week')->unsigned()->nullable()->default(0)->comment('Прегледи за седмица');
            $table->integer('views_month')->unsigned()->nullable()->default(0)->comment('Прегледи за месец');
            $table->integer('views_year')->unsigned()->nullable()->default(0)->comment('Прегледи за година');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('static_pages_i18n', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('static_page_id')->nullable(false);
            $table->unsignedBigInteger('language_id')->nullable(false);

            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('static_pages', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('static_pages_i18n', function (Blueprint $table) {
            $table->foreign('static_page_id')->references('id')->on('static_pages')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_pages_i18n');
        Schema::dropIfExists('static_pages');
    }
};
