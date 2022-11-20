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
        Schema::create('car_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generation_id')->nullable()
                ->references('id')->on('car_generations')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('model_id')->nullable()
                ->references('id')->on('car_models')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->nullable()
                ->references('id')->on('car_types')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
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
        Schema::dropIfExists('car_series');
    }
};
