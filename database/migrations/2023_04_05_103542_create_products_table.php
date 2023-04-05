<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->decimal('product_price', 10, 2);
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->timestamps();
        });

        // Customers Table
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone_number');
            $table->timestamps();
        });

        // Tables Table
        Schema::create('tables', function (Blueprint $table) {
            $table->id('table_id');
            $table->string('table_name');
            $table->enum('table_status', ['Occupied', 'Available']);
            $table->timestamps();
        });

        // QR Codes Table
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id('qr_code_id');
            $table->string('qr_code_value');
            $table->foreignId('table_id')->references('id')->on('tables');;
            $table->timestamps();
        });

        // Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('customer_id')->references('id')->on('customers');;
            $table->dateTime('order_datetime');
            $table->enum('order_status', ['Pending', 'Processing', 'Completed']);
            $table->timestamps();
        });

        // Order Items Table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->foreignId('order_id')->references('id')->on('orders');;
            $table->foreignId('product_id')->references('id')->on('products');;
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('qr_codes');
        Schema::dropIfExists('tables');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
    }
};
