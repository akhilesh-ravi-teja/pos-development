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
        // Invoices Table
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id');
            $table->foreignId('customer_id')->constrained('customers');
            $table->dateTime('invoice_datetime');
            $table->enum('invoice_status', ['Draft', 'Sent', 'Paid']);
            $table->timestamps();
        });

        // Invoice Items Table
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id('invoice_item_id');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        // Payments Table
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->dateTime('payment_datetime');
            $table->decimal('payment_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('payments');
    }

};
