<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->integer('id_user')->index('id_user');
            $table->integer('id_product');
            $table->integer('quantity');

            $table->primary(['id_product', 'id_user']);
        });

        DB::statement('ALTER TABLE cart ADD CONSTRAINT chk_cart_quantity CHECK (quantity > 0)');
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
};
