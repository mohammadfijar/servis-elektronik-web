<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null'); // teknisi
            $table->text('description');
            $table->text('diagnosis')->nullable(); // hasil pemeriksaan teknisi
            $table->text('action_taken')->nullable(); // apa yang diperbaiki/diganti
            $table->decimal('service_fee', 10, 2)->default(0); // biaya jasa servis
            $table->date('service_date');
            $table->enum('status', ['pending', 'in_progress', 'waiting_parts', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
