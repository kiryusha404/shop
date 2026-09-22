<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('id_order');
            $table->integer('id_product')->index('id_product');
            $table->decimal('price', 10);
            $table->integer('quantity');

            $table->primary(['id_order', 'id_product']);
        });


        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_price CHECK (price > 0)');
        DB::statement('ALTER TABLE order_items ADD CONSTRAINT chk_order_items_quantity CHECK (quantity > 0)');
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
