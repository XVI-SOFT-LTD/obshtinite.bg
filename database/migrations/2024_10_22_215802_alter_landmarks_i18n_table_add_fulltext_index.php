<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterLandmarksI18nTableAddFulltextIndex extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        DB::statement('ALTER TABLE landmarks_i18n ADD FULLTEXT fulltext_name_index (name)');
        DB::statement('ALTER TABLE landmarks_i18n ADD FULLTEXT fulltext_description_index (description)');
        DB::statement('ALTER TABLE landmarks_i18n ADD FULLTEXT fulltext_index (name, description)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE landmarks_i18n DROP INDEX fulltext_name_index');
        DB::statement('ALTER TABLE landmarks_i18n DROP INDEX fulltext_description_index');
        DB::statement('ALTER TABLE landmarks_i18n DROP INDEX fulltext_index');
    }
};