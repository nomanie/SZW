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
        Schema::create('authorized_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('identity_id')
                ->references('id')->on('identities')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('ip_address');
            $table->string('mac_address');
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
        Schema::dropIfExists('authorized_devices');
    }
};
