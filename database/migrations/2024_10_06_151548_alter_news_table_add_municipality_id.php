<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNewsTableAddMunicipalityId extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('municipality_id')->nullable()->after('author_id');
            
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('news', function (Blueprint $table) {
            // Първо премахнете външния ключ, ако е добавен
            $table->dropForeign(['municipality_id']);
            $table->dropColumn('municipality_id');
        });
    }
};