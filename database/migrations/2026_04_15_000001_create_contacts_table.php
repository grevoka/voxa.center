<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('profile')->nullable();
            $table->json('interests')->nullable();
            $table->text('message')->nullable();
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time')->nullable();
            $table->boolean('read')->default(false);
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
