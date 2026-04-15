<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('locale', 5)->default('fr');
            $table->string('login')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('setup_token', 64)->unique()->nullable();
            $table->timestamp('setup_token_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });

        Schema::dropIfExists('clients');
    }
};
