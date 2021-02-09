<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('bus_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('price');
            $table->enum('payment',['paypal','COH','paymaya']);
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
            // $table->foreign('bus_id')->references(('id'))->on('bus')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('bookings', function(Blueprint $table){
            $table ->dropForeign('account_id');
            $table->dropForeign('bus_id');
            $table->dropSoftDeletes();
            $table->dropTimestamps();
        });
    }
}

