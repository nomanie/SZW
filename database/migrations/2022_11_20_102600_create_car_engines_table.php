<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('car_engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->nullable()
                ->references('id')->on('car_models')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('series_id')->nullable()
                ->references('id')->on('car_series')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('generation_id')->nullable()
                ->references('id')->on('car_generations')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fuel_type_id')
                ->references('id')->on('car_fuel_types')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('start_production_date')->nullable();
            $table->integer('end_production_date')->nullable();
            $table->timestamps();
        });

        DB::table('car_engines')->insert([

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_engines');
    }
};
