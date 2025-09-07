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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
              //  , ProductID, SupplierID (إن وجدت), , TransactionType (إضافة أو صرف), UserID, Date
            $table->string('invoice_number');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id') ;
            $table->integer('transiction_no')->nullable();
            $table->decimal('total_price',18);
            $table->foreign('supplier_id')->references('id')->on('suppliers')->ondelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payment_methods')->ondelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
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
        Schema::dropIfExists('stocks');
    }
};
