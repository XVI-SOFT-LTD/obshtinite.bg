<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParliamentaryGroupI18nTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('parliamentary_group_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parliamentary_group_id')->comment('ID на парламентарната група');
            $table->unsignedBigInteger('language_id')->unsigned()->nullable(true);
            $table->string('name', 250)->comment('Преведено име на партията');
            $table->string('leader_name')->comment('Име на лидер на партията');
            $table->string('founder_name')->nullable()->comment('Име на основателя на партията');
            $table->text('description')->nullable()->comment('Описание');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('parliamentary_group_i18n', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_group');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('parliamentary_group_i18n', function (Blueprint $table) {
            $table->dropForeign(['parliamentary_group_id']);
            $table->dropForeign(['language_id']);
        });
        
        Schema::dropIfExists('parliamentary_group_i18n');
    }
};