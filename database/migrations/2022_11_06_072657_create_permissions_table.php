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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('section');
        });
        DB::table('permissions')->insert([
            // pracownicy
            ['name' => 'create', 'section' => 'workers'],
            ['name' => 'read', 'section' => 'workers'],
            ['name' => 'update', 'section' => 'workers'],
            ['name' => 'delete', 'section' => 'workers'],
            // permisje
            ['name' => 'add', 'section' => 'permissions'],
            ['name' => 'remove', 'section' => 'permissions'],
            // klienci
            ['name' => 'create', 'section' => 'clients'],
            ['name' => 'read', 'section' => 'clients'],
            ['name' => 'update', 'section' => 'clients'],
            ['name' => 'delete', 'section' => 'clients'],
            ['name' => 'registerAsUser', 'section' => 'clients'],
            ['name' => 'requestShareData', 'section' => 'clients'],
            // pojazdy
            ['name' => 'create', 'section' => 'cars'],
            ['name' => 'read', 'section' => 'cars'],
            ['name' => 'update', 'section' => 'cars'],
            ['name' => 'delete', 'section' => 'cars'],
            ['name' => 'attachToClient', 'section' => 'cars'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
