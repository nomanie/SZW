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
            $table->json('place')->nullable();
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
