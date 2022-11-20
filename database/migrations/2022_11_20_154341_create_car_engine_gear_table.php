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
        Schema::create('car_engine_gear', function (Blueprint $table) {
            $table->id();
            $table->foreignId('engine_id')
                ->references('id')->on('car_engines')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('manual')->default(true);
            $table->integer('gear_number')->nullable();
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
        Schema::dropIfExists('car_engine_gear');
    }
};
