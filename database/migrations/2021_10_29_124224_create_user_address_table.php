<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('country_id');
            $table->string('postal_code');
            $table->enum('address_type', ['H', 'O'])->comments(['H' => 'home address', 'O' => 'office address'])->default('H');
            $table->bigInteger('user_id')->unique();
            $table->text('default_address');
            $table->text('instruction');
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
        Schema::dropIfExists('user_address');
    }
}
