<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('time_slot');
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['date', 'time_slot']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
