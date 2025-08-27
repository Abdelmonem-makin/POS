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
        Schema::create('daily_revenues', function (Blueprint $table) {
            $table->id();
            // رقم الإيراد (توليد تلقائي مثل REV-00001)
            $table->string('revenue_number')->unique();
 
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('shift_id');
            $table->integer('order_count')->default(0);
            $table->decimal('total_net', 12, 2)->default(0);
            $table->date('revenue_date');
            $table->unsignedBigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('users')->ondelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->ondelete('cascade');
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
        Schema::dropIfExists('daily_revenues');
    }
};
