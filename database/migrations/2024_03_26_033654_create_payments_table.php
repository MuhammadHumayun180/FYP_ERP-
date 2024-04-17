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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sales_service_id')->nullable();
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->enum('transaction_type', ['purchase', 'sale'])->nullable();
            $table->enum('payment_status', ['pending', 'completed'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->nullable(); // Payment method (e.g., bank transfer, credit card)
            $table->string('bank_name')->nullable(); // Bank name
            $table->string('bank_account_number')->nullable(); // Bank account number
            $table->string('transaction_reference')->nullable(); // Transaction reference number
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('sales_service_id')->references('id')->on('sales_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
