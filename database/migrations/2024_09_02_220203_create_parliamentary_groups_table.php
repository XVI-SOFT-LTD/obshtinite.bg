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
        Schema::create('parliamentary_groups', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 250)->nullable()->comment('Лого на парламентарната група');
            $table->string('slug')->comment('Секретно име на партията');
            $table->date('founding_date')->comment('Дата на основаване на партията');
            $table->string('headquarters_address')->comment('Адрес на централата на партията');
            $table->integer('seats_in_parliament')->comment('Брой места, които партията заема в парламента');
            $table->string('website')->nullable()->comment('Уебсайт на партията');
            $table->string('founder_name')->comment('Име на основателя на партията');
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
        });

        Schema::create('parliamentary_group_i18n', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parliamentary_group_id')->comment('ID на парламентарната група');
            $table->unsignedBigInteger('language_id')->unsigned()->nullable(true);
            $table->string('name', 250)->comment('Преведено име на партията');
            $table->string('leader_name')->comment('Име на лидер на партията');
            $table->text('description')->nullable()->comment('Описание');
            $table->timestamps();
            $table->softDeletes();
        });

         Schema::create('parliamentary_group_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parliamentary_group_id')->unsigned()->nullable(false);
            $table->string('filename', 100);

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('parliamentary_groups', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::table('parliamentary_group_i18n', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_groups');
            $table->foreign('language_id')->references('id')->on('languages');
        });

         Schema::table('affiliated_p_pg', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_groups')->onDelete('cascade');
            $table->foreign('affiliated_party_id')->references('id')->on('parliamentary_groups')->onDelete('cascade');
        });

        Schema::table('parliamentary_group_gallery', function (Blueprint $table) {
            $table->foreign('parliamentary_group_id')->references('id')->on('parliamentary_groups')->onDelete('cascade');
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

        Schema::table('affiliated_p_pg', function (Blueprint $table) {
            $table->dropForeign(['parliamentary_group_id']);
            $table->dropForeign(['affiliated_party_id']);
        });

        Schema::table('parliamentary_group_i18n', function (Blueprint $table) {
            $table->dropForeign(['parliamentary_group_id']);
            $table->dropForeign(['language_id']);
        });

        Schema::table('parliamentary_groups', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });
        
        Schema::dropIfExists('parliamentary_groups');
        Schema::dropIfExists('affiliated_p_pg');
        Schema::dropIfExists('parliamentary_group_i18n');
        Schema::dropIfExists('parliamentary_group_gallery');
    }
};