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
        Schema::create('workshop_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')
                ->references('id')->on('system.workshops')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('city');
            $table->string('street');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('zip_code');
            $table->string('building_number');
            $table->string('flat_number')->nullable();
            $table->json('social_media')->nullable();
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
        Schema::dropIfExists('workshop_places');
    }
};
