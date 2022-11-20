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
        Schema::create('car_fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $now = Carbon::now();
        DB::table('car_fuel_types')->insert([
            ['name' => 'diesel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'gasoline', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'lpg', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_fuel_types');
    }
};
