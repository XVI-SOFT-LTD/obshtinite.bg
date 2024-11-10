<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMunicipalitiesI18nTableAddMayorColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('municipalities_i18n', function (Blueprint $table) {
            $table->string('mayor')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipalities_i18n', function (Blueprint $table) {
             $table->dropColumn('mayor');
        });
    }
};