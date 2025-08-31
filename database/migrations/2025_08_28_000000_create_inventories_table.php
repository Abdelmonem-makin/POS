<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
