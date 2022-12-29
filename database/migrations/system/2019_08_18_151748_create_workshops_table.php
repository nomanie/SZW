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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('tenancy_db_name')->nullable()->unique();
            $table->foreignId('identity_id')
                ->references('id')->on('identities')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->json('owners')->nullable();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('nip');
            $table->string('regon');
            $table->date('company_created_at')->nullable();
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
        Schema::dropIfExists('workshops');
    }
};
