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
        // migrations/xxxx_create_transactions_table.php
        Schema::create('transactions', function (Blueprint $t) {
            $t->id();
            $t->string('invoice_no')->unique();
            $t->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $t->foreignId('staff_id')->constrained('users')->onDelete('cascade'); // kasir
            $t->decimal('total', 10, 2);
            $t->decimal('paid', 10, 2);
            $t->decimal('change', 10, 2);
            $t->decimal('discount', 10, 2)->default(0);
            $t->decimal('grand_total', 10, 2);
            $t->enum('payment_method', ['cash', 'card', 'transfer', 'ewallet'])->default('cash');
            $t->enum('status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $t->timestamps();
        });

        // migrations/xxxx_create_transaction_items_table.php
        Schema::create('transaction_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $t->nullableMorphs('itemable'); // bisa Item atau Service
            $t->integer('quantity')->default(1);
            $t->decimal('price', 10, 2);
            $t->decimal('subtotal', 10, 2);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
