<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->integer('id_status')->index('id_status');
            $table->decimal('total_price', 10, 2);
            $table->text('text_reason')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });


        DB::statement('ALTER TABLE orders ADD CONSTRAINT chk_orders_total_price CHECK (total_price > 0)');
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
