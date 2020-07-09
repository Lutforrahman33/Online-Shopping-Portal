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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('name');
            $table->string('phone_number');
            $table->text('delivery_address');
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_seenByAdmin')->default(0);
            $table->string('transection_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                   ->references('id')->on('users')
                   ->onDelete('cascade');

            $table->foreign('payment_id')
                   ->references('id')->on('payments')
                   ->onDelete('cascade');       
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
