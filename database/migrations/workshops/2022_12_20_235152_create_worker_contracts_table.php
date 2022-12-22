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
        Schema::create('worker_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->references('id')->on('workers')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('position')->nullable();
            $table->date('contract_from')->nullable();
            $table->date('contract_to')->nullable();
            $table->integer('contract_type')->nullable();
            $table->float('salary')->nullable();
            $table->date('archived_at')->nullable();
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
        Schema::dropIfExists('archived_worker_contracts');
    }
};
