<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();  //$table->bigIncrements('id')
            $table->string('invoice_number',50);
            $table->string('product',50);
            $table->string('Section',999);
            $table->string('status',50);
            $table->integer('value_status');
            $table->string('user',300);
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();

            $table->unsignedBigInteger('id_Invoice');
            $table->foreign('id_Invoice')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoices_details');
    }
}
