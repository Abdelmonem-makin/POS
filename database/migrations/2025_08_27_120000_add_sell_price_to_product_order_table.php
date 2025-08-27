<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_order', function (Blueprint $table) {
            if (!Schema::hasColumn('product_order', 'sell_price')) {
                $table->decimal('sell_price', 18, 2)->default(0)->after('quantity');
            }
        });
    }

    public function down()
    {
        Schema::table('product_order', function (Blueprint $table) {
            if (Schema::hasColumn('product_order', 'sell_price')) {
                $table->dropColumn('sell_price');
            }
        });
    }
};
