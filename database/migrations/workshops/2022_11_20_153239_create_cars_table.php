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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->references('id')->on('clients')
                ->cascadeOnDelete()->cascadeOnUpdate();
//            $table->foreignId('global_car_id')
//                ->nullable()->references('id')->on('system.cars') //@todo po dodaniu cars do systemowej bazy podpiąć tutaj fk
//                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('brand')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('model')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('generation')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('seria')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('engine')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('car_type')->nullable(); // @todo później foreignId z systemowych tabel
            $table->string('registration_number')->nullable();
            $table->string('vin_number')->nullable();
            $table->string('production_date')->nullable();
            $table->integer('distance')->nullable();
            $table->string('notes')->nullable();
            $table->date('inspection_date')->nullable();
            $table->date('insurance_date')->nullable();
            $table->json('additional_owners')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('cars');
    }
};
