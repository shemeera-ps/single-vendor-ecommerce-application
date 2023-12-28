<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->dateTime('invoice_date');
            $table->dateTime('due_date');
            $table->string('invoice_status');

            $table->integer('sub_total');
            $table->integer('tax_amount');
            $table->integer('discount_amount');
            $table->integer('total_amount');
            $table->dateTime('payment_date');
            $table->string('billing_information');
            $table->string('payment_method');
            $table->string('currency');
            $table->string('payment status');
            $table->string('shipping_information');
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
