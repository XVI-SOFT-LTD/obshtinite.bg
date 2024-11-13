<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id')->onDelete('cascade')->comment('ID на баннер');
            $table->unsignedBigInteger('category_id')->onDelete('cascade')->comment('ID на категорията');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('banners_categories', function (Blueprint $table) {
            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_categories', function (Blueprint $table) {
            $table->dropForeign(['banner_id']);
            $table->dropForeign(['category_id']);
        });
        
        Schema::dropIfExists('banners_categories');
    }
};