<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
           // $table->string('phone');
           // $table->string('email');
           // $table->string('customer_name');
          //  $table->string('country');
          //  $table->string('city');
           // $table->string('address');
           // $table->string('payment_method');
            $table->date('date');
            $table->string('status')->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 