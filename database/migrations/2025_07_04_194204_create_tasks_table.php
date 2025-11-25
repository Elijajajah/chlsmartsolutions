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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->longText('description')->nullable();
            $table->enum('type', ['government', 'walk_in', 'project_based', 'online']);
            $table->unsignedSmallInteger('tax');
            $table->enum('payment_method', ['none', 'cheque', 'bank_transfer', 'cash', 'ewallet'])->default('none');
            $table->decimal('price', 12, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'canceled', 'unassigned'])->default('unassigned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
