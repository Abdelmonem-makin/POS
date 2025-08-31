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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            // $table->string('photo');
            $table->string('descount')->default(0);
            // $table->string('discription');
            $table->decimal('price',18)->unsigned();
            $table->decimal('sell_price',18)->unsigned();
            $table->integer('Quantity');
            $table->boolean('status');
            $table->string('add_by')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->ondelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
