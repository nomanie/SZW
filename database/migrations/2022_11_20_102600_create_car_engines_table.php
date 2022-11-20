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
            $table->foreignId('series_id')
                ->references('id')->on('car_series')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fuel_type_id')
                ->references('id')->on('car_fuel_type')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('start_production_date');
            $table->integer('end_production_date');
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
