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
         Schema::create('parliamentary_group_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parliamentary_group_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('parliamentary_group_gallery', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parliamentary_group_gallery', function (Blueprint $table) {
            $table->dropForeign(['parliamentary_group_id']);
        });
        
        Schema::dropIfExists('parliamentary_group_gallery');
    }
};