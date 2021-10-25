<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSteeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_steeings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('email');
            $table->string('address');
            $table->text('terms_and_conditions');
            $table->string('footer_text');
            $table->integer('charge');
            $table->integer('landline');
            $table->string('website');
            $table->string('logo');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('pinterest');
            $table->string('whatsapp');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
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
        Schema::dropIfExists('site_steeings');
    }
}
