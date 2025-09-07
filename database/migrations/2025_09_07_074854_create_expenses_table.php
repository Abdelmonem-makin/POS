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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان المصروف
            $table->text('description')->nullable(); // وصف تفصيلي
            $table->decimal('amount', 10, 2); // قيمة المصروف
            $table->date('expense_date'); // تاريخ المصروف
            $table->string('category')->nullable(); // نوع المصروف (اختياري)
            $table->unsignedBigInteger('user_id') ;
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
        Schema::dropIfExists('expenses');
    }
};
