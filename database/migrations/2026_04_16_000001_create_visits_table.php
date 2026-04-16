<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 64)->index();
            $table->string('ip', 45)->nullable();
            $table->string('url', 2048);
            $table->string('path', 512)->index();
            $table->string('referrer', 2048)->nullable();
            $table->string('referrer_host', 255)->nullable()->index();
            $table->string('user_agent', 1024)->nullable();
            $table->enum('device', ['desktop', 'mobile', 'tablet'])->default('desktop')->index();
            $table->string('browser', 50)->nullable()->index();
            $table->string('browser_version', 20)->nullable();
            $table->string('os', 50)->nullable()->index();
            $table->string('country', 2)->nullable()->index();
            $table->boolean('is_bounce')->default(true);
            $table->unsignedSmallInteger('duration')->default(0);
            $table->timestamp('created_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
