<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_additional_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')
                ->references('id')->on('system.workshops')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('type');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_additional_fields');
    }
};
