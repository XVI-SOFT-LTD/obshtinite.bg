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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('news_id')->nullable(true);
            $table->unsignedBigInteger('category_id')->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('news_categories', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_categories');
    }
};
