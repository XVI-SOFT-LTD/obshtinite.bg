<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomButtonsTable extends Migration
{
    public function up()
    {
        Schema::create('custom_buttons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->boolean('active')->default(false);
            $table->text('description')->nullable();
            $table->string('logo', 250)->nullable();
            $table->morphs('buttonable'); // This will create buttonable_id and buttonable_type columns
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_buttons');
    }
}