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
            $table->unsignedBigInteger('orderNumber');
            $table->unsignedBigInteger('invoiceNumber')->nullable();
            $table->decimal('totalAmount')->nullable();
            $table->string('customerName');
            $table->unsignedBigInteger('trackingNumber')->nullable();
            $table->timestamp('shippingDate')->nullable();
            $table->string('shippingMethod')->nullable();
            $table->timestamp('deliveryDate')->nullable();
            $table->string('owner')->nulluble();
            $table->string('orderStatus')->default('new');
            $table->boolean('shipped')->default(false);
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
