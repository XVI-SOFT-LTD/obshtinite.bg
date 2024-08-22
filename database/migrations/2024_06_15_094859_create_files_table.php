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
        Schema::create('files', function (Blueprint $table) {
            $table->id();

            $table->string('filename', 100);
            $table->string('original_filename', 100)->nullable(true)->comment('Оригинално име на файла');
            $table->unsignedBigInteger('object_id')->nullable(false)->comment('ID на обект');
            $table->string('object_type')->nullable(false)->comment('Посочва се eloquent model namespace');
            $table->string('object_table')->nullable(false)->comment('Таблица на обекта');

            $table->unsignedTinyInteger('sortorder')->nullable(true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
