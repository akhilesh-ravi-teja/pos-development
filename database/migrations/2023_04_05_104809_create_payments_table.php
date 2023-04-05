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
          // Payments Table
          Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->dateTime('payment_datetime');
            $table->decimal('payment_amount', 10, 2);
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
        Schema::dropIfExists('payments');
    }
};
