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
        Schema::create('document_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')
                ->references('id')->on('documents')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->integer('units');
            $table->double('unit_cost');
            $table->integer('vat_rate_id');
            $table->double('sum_net');
            $table->double('sum_vat');
            $table->double('sum_gross');
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
        Schema::dropIfExists('document_contents');
    }
};
