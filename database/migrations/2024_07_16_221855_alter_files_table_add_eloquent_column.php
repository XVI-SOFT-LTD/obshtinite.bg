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
        Schema::table('files', function (Blueprint $table) {
            $table->string('object_eloquent')->default(null)->after('object_id')->comment('Посочва се eloquent model namespace');
            DB::statement('ALTER TABLE `files` CHANGE `object_type` `object_type` VARCHAR(255) COMMENT "Посочва се типа на обекта към който е прикачен файлът"');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('object_eloquent');
        });
    }
};
