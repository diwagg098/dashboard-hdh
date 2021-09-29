<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartroom', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_guest');
            $table->string('cartr_id');
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('jumlah_tamu');
            $table->string('tipe_kamar');
            $table->string('status_cart');
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
        Schema::dropIfExists('cartroom');
    }
}
