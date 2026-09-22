<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('img', 100);
            $table->decimal('price', 10, 2);
            $table->string('country', 100);
            $table->year('year');
            $table->string('model', 100);
            $table->integer('quantity')->default(0);
            $table->integer('id_category')->index('id_category');
        });

        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_price CHECK (price > 0)');
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_products_quantity CHECK (quantity >= 0)');
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
