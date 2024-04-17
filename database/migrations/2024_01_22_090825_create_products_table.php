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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('sku')->unique();
            // $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            // $table->string('model')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->decimal('total_price', 8, 2)->default(0.00);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            // $table->decimal('amount_paid', 8, 2)->default(0.00);
            // $table->enum('payment_status', ['pending', 'completed'])->default('pending');
            // $table->string('transaction_id')->nullable();
            // $table->string('payment_method')->nullable(); // Payment method (e.g., bank transfer, credit card)
            // $table->string('bank_name')->nullable(); // Bank name
            // $table->string('bank_account_number')->nullable(); // Bank account number
            // $table->string('transaction_reference')->nullable(); // Transaction reference number

            $table->timestamps();


             // Define foreign key constraint
             $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
