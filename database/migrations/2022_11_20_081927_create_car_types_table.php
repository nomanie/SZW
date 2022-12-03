<?php

use Carbon\Carbon;
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
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $now = Carbon::now();
        DB::table('car_types')->insert([
            ['name' => 'Sedan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hatchback', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kombi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Liftback', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SUV', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Crossover', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Van', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Minivan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pickup', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Coupe', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kabriolet', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Roadster', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_types');
    }
};
