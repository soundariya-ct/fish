<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('tamil_name')->unique();
            $table->string('english_name')->unique();
            $table->string('slug')->unique();
            $table->enum('type', ['1', '2', '3'])->comments('1 -> small, 2 -> medium, 3 -> large')->default('1');
            $table->decimal('grossweight');
            $table->decimal('netweight');
            $table->decimal('regular_price');
            $table->decimal('sale_price')->nullable();
            $table->enum('is_stock_available', ['0', '1'])->comments('0 -> No, 1 -> Yes')->default('1');
            $table->string('stock')->nullable();
            $table->integer('status')->comment('0 = inactive,1 = active')->default(1);
            $table->enum('is_product_customizeable', ['0', '1'])->comments('0 -> No, 1 -> Yes')->default('0');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('image')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Revese the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
