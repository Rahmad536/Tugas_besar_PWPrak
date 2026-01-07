<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('location');
            $table->string('program');
            $table->string('tree_type');
            $table->integer('quantity');
            $table->decimal('price_per_tree', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->string('donor_name');
            $table->string('donor_email');
            $table->enum('status', ['pending', 'paid', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
