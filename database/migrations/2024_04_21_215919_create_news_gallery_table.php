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
        Schema::create('news_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('news_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('news_gallery', function (Blueprint $table) {
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_gallery');
    }
};
