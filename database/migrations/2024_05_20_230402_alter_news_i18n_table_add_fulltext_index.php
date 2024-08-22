<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE news_i18n ADD FULLTEXT fulltext_title_index (title)');
        DB::statement('ALTER TABLE news_i18n ADD FULLTEXT fulltext_description_index (description)');
        DB::statement('ALTER TABLE news_i18n ADD FULLTEXT fulltext_index (title, description)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE news_i18n DROP INDEX fulltext_title_index');
        DB::statement('ALTER TABLE news_i18n DROP INDEX fulltext_description_index');
        DB::statement('ALTER TABLE news_i18n DROP INDEX fulltext_index');
    }
};
