<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('item_id');
            $table->Integer('variation_id');
            $table->bigInteger('user_id')->unique();
            $table->string('order_image')->unique();
            $table->decimal('price', 10, 7);
            $table->Integer('quantity');
            $table->decimal('referral_number', 10, 7);
            $table->decimal('user_amount', 10, 7);
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
        Schema::dropIfExists('order_details');
    }
}
