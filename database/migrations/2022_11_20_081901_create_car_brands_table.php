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
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id();
            $table->name();
            $table->smallInteger('brand_popularity'); // 0 - popularne, 1 - mniej popularne, 2 - archiwalne
            $table->timestamps();
        });

        DB::table('car_brands')->insert([
            // A
            ['Abarth', 1],
            ['Acura', 2],
            ['Audi', 0],
            ['Alfa Romeo', 0],
            ['Alpine', 1],
            ['Andoria', 2],
            ['Aston Martin', 1],
            ['Autobianchi', 2],
            // B
            ['Bentley', 1],
            ['BMW', 0],
            // C
            ['Cadillac', 2],
            ['Chevrolet', 0],
            ['Chrysler', 2],
            ['Citroen', 0],
            ['Cupra', 1],
            // D
            ['Dacia', 0],
            ['Daewoo', 0],
            ['Daewoo Motor', 2],
            ['Damis', 2],
            ['DMC', 2],
            ['Dodge', 1],
            ['DS', 1],
            // E
            // F
            ['Ferrari', 1],
            ['Fiat', 0],
            ['Ford', 0],
            ['FSO', 2],
            ['Fuso', 1],
            // G
            ['GAZ', 2],
            ['GAZ-AVC', 2],
            // H
            ['Honda', 0],
            ['Hummer', 2],
            ['Hyundai', 0],
            // I
            ['Ineos', 1],
            ['Infiniti', 0],
            ['Intrall', 2],
            ['Isuzu', 1],
            ['Iveco', 1],
            ['Izera', 2],
            // J
            ['Jaguar', 1],
            ['Jeep', 1],
            // K
            ['Kawasaki', 1],
            ['Kia', 0],
            // L
            ['Lada', 2],
            ['Lamborghini', 1],
            ['Lancia', 2],
            ['Land Rover', 1],
            ['LDV', 2],
            ['LEVC', 1],
            ['Lexus', 0],
            ['Ligier', 2],
            ['Lotus', 2],
            ['LTI', 2],
            // M
            ['MAN', 1],
            ['Maserati', 1],
            ['Maybach', 1],
            ['Mazda', 0],
            ['Maxus', 1],
            ['Mercedes', 0],
            ['McLaren', 1],
            ['MG', 2],
            ['MINI', 0],
            ['Mitsubishi', 0],
            // N
            ['Nissan', 0],
            // O
            ['Opel', 0],
            // P
            ['Peugeot', 0],
            ['Piaggio', 1],
            ['Polski Fiat', 2],
            ['Porsche', 1],
            // R
            ['RAM', 1],
            ['Renault', 0],
            ['Renault Trucks', 1],
            ['Rolls-Royce', 1],
            ['Rover', 2],
            // S
            ['Saab', 2],
            ['Seat', 0],
            ['Seres', 1],
            ['Skoda', 0],
            ['Skywell', 1],
            ['Smart', 0],
            ['SsangYong', 1],
            ['Subaru', 0],
            ['Suzuki', 0],
            // T
            ['Tata', 2],
            ['Tesla', 1],
            ['Toyota', 0],
            // U
            // W
            ['WSK Mielec', 2],
            // V
            ['Volkswagen', 0],
            ['Volvo', 0],
            // Z
            ['ZD', 2],
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
