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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('municipality_id')->nullable();
            $table->string('title', 500)->comment('Заглавие на новината');
            $table->text('description')->comment('Съдържание на новината');
            $table->string('logo')->nullable()->comment('Лого на новината');
            $table->string('url')->comment('URL на новината');
            $table->datetime('publish_date')->nullable()->comment('Дата на публикуване на новината');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
