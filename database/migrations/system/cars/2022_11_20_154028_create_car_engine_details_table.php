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
        Schema::create('car_engine_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('engine_id')
                ->references('id')->on('car_engines')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('max_troque')->nullable();
            $table->string('camshaft_location')->nullable();
            $table->string('cylinder_arrangement')->nullable();
            $table->string('compression_ratio')->nullable();
            $table->string('start')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('power')->nullable();
            $table->string('top_up')->nullable();
            $table->string('cylinders_number')->nullable();
            $table->string('valves_number')->nullable();
            $table->string('Bore_x_stroke')->nullable();
            $table->string('injection_type')->nullable();
            $table->string('fuel_system')->nullable();
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
        Schema::dropIfExists('car_engine_details');
    }
};
