<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAreasI18nTableAddAddressColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('areas_i18n', function (Blueprint $table) {
            $table->string('address')->nullable()->after('description');
            $table->string('regional_center')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_i18n', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('regional_center');
        });
    }
};