<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('order_number')->unique();
            $table->bigInteger('user_id')->unique();
            $table->integer('driver_id');
            $table->enum('payment_type', ['1', '2'])->comments(['1' => 'cash on deliver', '2' => 'online payment'])->default('2');
            $table->enum('order_type', ['D', 'C', 'P'])->comments(['D' => 'delivered', 'C' => 'cancelled', 'P' => 'pickup'])->default('P');
            $table->text('address');
            $table->string('pincode');
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->string('promo_code');
            $table->string('discount_amount');
            $table->string('discount_pr');
            $table->string('tax');
            $table->integer('status');
            $table->softDeletes();
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
}
