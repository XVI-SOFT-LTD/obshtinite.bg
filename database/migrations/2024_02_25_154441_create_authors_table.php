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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->string('logo', 250)->nullable(true);
            $table->string('slug', 250)->nullable(true);
            $table->boolean('active')->unsigned()->nullable()->default(1);

            $table->integer('views')->unsigned()->nullable()->default(0)->comment('Общо прегледи');
            $table->integer('views_day')->unsigned()->nullable()->default(0)->comment('Прегледи за ден');
            $table->integer('views_week')->unsigned()->nullable()->default(0)->comment('Прегледи за седмица');
            $table->integer('views_month')->unsigned()->nullable()->default(0)->comment('Прегледи за месец');
            $table->integer('views_year')->unsigned()->nullable()->default(0)->comment('Прегледи за година');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('authors_i18n', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('author_id')->nullable(true);
            $table->unsignedBigInteger('language_id')->unsigned()->nullable(true);

            $table->string('fullname', 250)->nullable(true);
            $table->text('description')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::table('authors_i18n', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors_i18n');
        Schema::dropIfExists('authors');
    }
};
