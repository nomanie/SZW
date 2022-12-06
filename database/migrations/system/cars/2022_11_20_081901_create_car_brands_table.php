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
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('brand_popularity'); // 0 - popularne, 1 - mniej popularne, 2 - archiwalne
            $table->timestamps();
        });
        $now = Carbon::now();
        DB::table('car_brands')->insert([
            // A
            ['name' => 'Abarth', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Acura', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Audi', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Alfa Romeo', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Alpine', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Andoria', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Aston Martin', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Autobianchi', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // B
            ['name' => 'Bentley', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BMW', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // C
            ['name' => 'Cadillac', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chevrolet', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chrysler', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Citroen', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cupra', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            // D
            ['name' => 'Dacia', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Daewoo', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Daewoo Motor', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Damis', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DMC', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dodge', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DS', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            // E
            // F
            ['name' => 'Ferrari', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fiat', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ford', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'FSO', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fuso', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            // G
            ['name' => 'GAZ', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'GAZ-AVC ', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // H
            ['name' => 'Honda', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hummer', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hyundai', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // I
            ['name' => 'Ineos', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Infiniti', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Intrall', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Isuzu', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Iveco', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Izera', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // J
            ['name' => 'Jaguar', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Jeep', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            // K
            ['name' => 'Kawasaki', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kia', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // L
            ['name' => 'Lada', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lamborghini', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lancia', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Land Rover', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LDV', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LEVC', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lexus', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ligier', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lotus', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LTI', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // M
            ['name' => 'MAN', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maserati', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maybach', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mazda', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maxus', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mercedes', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'McLaren', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MG', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MINI', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mitsubishi', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // N
            ['name' => 'Nissan', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // O
            ['name' => 'Opel', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // P
            ['name' => 'Peugeot', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Piaggio', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Polski Fiat', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Porsche', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            // R
            ['name' => 'RAM', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Renault', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Renault Trucks', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rolls-Royce', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rover', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // S
            ['name' => 'Saab', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Seat', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Seres', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Skoda', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Skywell', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Smart', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SsangYong', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Subaru', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Suzuki', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // T
            ['name' => 'Tata', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tesla', 'brand_popularity' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Toyota', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // U
            // W
            ['name' => 'WSK Mielec', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now],
            // V
            ['name' => 'Volkswagen', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Volvo', 'brand_popularity' => 0, 'created_at' => $now, 'updated_at' => $now],
            // Z
            ['name' => 'ZD', 'brand_popularity' => 2, 'created_at' => $now, 'updated_at' => $now]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_brands');
    }
};
