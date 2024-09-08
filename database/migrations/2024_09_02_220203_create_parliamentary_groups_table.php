<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParliamentaryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parliamentary_group', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на парламентарната група');
            $table->string('slug')->comment('Секретно име на партията');
            $table->date('founding_date')->comment('Дата на основаване на партията');
            $table->string('headquarters_address')->comment('Адрес на централата на партията');
            $table->integer('seats_in_parliament')->nullable()->comment('Брой места, които партията заема в парламента');
            $table->string('website')->nullable()->comment('Уебсайт на партията');
            $table->string('contact_email')->nullable()->comment('Имейл за контакт');
            $table->string('contact_phone')->nullable()->comment('Телефон за контакт');
            $table->json('social_media_links')->nullable()->comment('Линкове към социалните мрежи');
            $table->boolean('active')->unsigned()->nullable()->default(1)->comment('Статус на партията');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('affiliated_p_pg', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parliamentary_group_id')->onDelete('cascade')->comment('ID на парламентарната група');
            $table->unsignedBigInteger('affiliated_party_id')->onDelete('cascade')->comment('ID на свързаната партия');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('parliamentary_group', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

         Schema::table('affiliated_p_pg', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_group')->onDelete('cascade');
            $table->foreign('affiliated_party_id')->references('id')->on('parliamentary_group')->onDelete('cascade');
        });
    }

     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliated_p_pg', function (Blueprint $table) {
            $table->dropForeign(['parliamentary_group_id']);
            $table->dropForeign(['affiliated_party_id']);
        });

        Schema::table('parliamentary_group', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        
        Schema::dropIfExists('parliamentary_group');
        Schema::dropIfExists('affiliated_p_pg');
    }
};