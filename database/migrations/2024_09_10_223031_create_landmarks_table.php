<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandmarksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на забележителността');
            $table->string('slug')->comment('Секретно име на забележителността');
            $table->unsignedBigInteger('municipality_id')->comment('Релация към община');
            $table->string('longitude')->nullable()->comment('Географска дължина');
            $table->string('working_hours')->nullable()->comment('Работно време');
            $table->string('latitude')->nullable()->comment('Географска ширина');
            $table->boolean('active')->unsigned()->nullable()->default(1)->comment('Статус на забележителността');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landmarks', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        
        Schema::dropIfExists('landmarks');
    }
};