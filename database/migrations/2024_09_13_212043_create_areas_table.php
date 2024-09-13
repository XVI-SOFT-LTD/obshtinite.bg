<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на областта');
            $table->string('slug')->comment('Секретно име на областта');
            $table->string('website')->nullable()->comment('Уебсайт на областта');
            $table->json('social_media_links')->nullable()->comment('Линкове към социалните мрежи');
            $table->integer('population')->unsigned()->nullable()->comment('Население на областта');
            $table->integer('area')->nullable()->comment('Площ на областта');
            $table->boolean('active')->unsigned()->nullable()->default(1)->comment('Статус на партията');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        
        Schema::dropIfExists('areas');
    }
};