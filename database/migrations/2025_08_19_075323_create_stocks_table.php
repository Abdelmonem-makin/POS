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
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->unsignedBigInteger('supplier_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->date('expir_data');
            $table->char('TransactionType');
            $table->decimal('price',18)->unsigned();
            $table->integer('Quantity');
            $table->foreign('product_id')->references('id')->on('products')->ondelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->ondelete('cascade');
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
