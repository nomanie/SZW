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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->references('id')->on('clients')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('car_id')
                ->references('id')->on('cars')
                ->cascadeOnUpdate()->cascadeOnDelete();
//            $table->foreignId('repair_id')
//                ->references('id')->on('repairs') //@todo po dodaniu zleceń zaktualizować tabele
//                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('fv_number')->unique();
            $table->string('issuer_name');
            $table->string('issuer_address');
            $table->string('issuer_zip_code');
            $table->string('issuer_nip');
            $table->string('recipient_name');
            $table->string('recipient_address');
            $table->string('recipient_zip_code');
            $table->string('fv_header')->nullable();
            $table->string('fv_footer')->nullable();
            $table->date('issue_at')->nullable();
            $table->date('sale_at')->nullable();
            $table->integer('payment_type');
            $table->date('payment_date');
            $table->string('account_number');
            $table->integer('bank_type')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
