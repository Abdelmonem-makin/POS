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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('shift_id');
            $table->string('invoice_number')->nullable();
            $table->integer('phone')->nullable();
            $table->double('total_price');
            $table->integer('profit')->default(0);
            $table->foreign('payment_id')->references('id')->on('payment_methods')->ondelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->ondelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
