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
        $workshopDBs = DB::select(DB::raw('SELECT schema_name FROM information_schema.schemata WHERE schema_name LIKE "Warsztat_%"'));

        foreach ($workshopDBs as $db) {
            DB::statement("DROP DATABASE " . $db->schema_name);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
