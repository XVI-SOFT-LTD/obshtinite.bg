<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participations_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participation_id')->onDelete('cascade')->comment('ID на участието');
            $table->unsignedBigInteger('category_id')->onDelete('cascade')->comment('ID на категорията');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participations_categories', function (Blueprint $table) {
            $table->foreign('participation_id')->references('id')->on('participations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participations_categories', function (Blueprint $table) {
            $table->dropForeign(['participation_id']);
            $table->dropForeign(['category_id']);
        });
        
        Schema::dropIfExists('participations_categories');
    }
};