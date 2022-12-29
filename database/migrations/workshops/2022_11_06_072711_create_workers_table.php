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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')->references('id')->on('system.workshops')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('identity_id')->references('id')->on('system.identities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('login');
            $table->string('phone')->nullable();
            $table->string('info')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('change_password_on_login')->default(true);
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
        Schema::dropIfExists('workers');
    }
};
