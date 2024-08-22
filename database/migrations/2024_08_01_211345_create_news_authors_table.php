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
        Schema::create('news_authors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('news_id')->nullable(true);
            $table->unsignedBigInteger('author_id')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('news_authors', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_authors');
    }
};
