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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id')->nullable()->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['cheque', 'bank_transfer', 'cash', 'ewallet'])->default('none')->nullable();
            $table->enum('type', ['government', 'walk_in', 'project_based', 'online']);
            $table->enum('status', ['pending', 'completed', 'canceled', 'reserved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
