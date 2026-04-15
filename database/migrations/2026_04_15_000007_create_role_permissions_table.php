<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('role', 20);
            $table->string('section', 50);
            $table->unique(['role', 'section']);
        });

        $sections = ['dashboard', 'contacts', 'users', 'calendar', 'schedule', 'smtp', 'password'];
        foreach ($sections as $section) {
            DB::table('role_permissions')->insert(['role' => 'admin', 'section' => $section]);
        }

        foreach (['partner', 'editor'] as $role) {
            DB::table('role_permissions')->insert(['role' => $role, 'section' => 'dashboard']);
            DB::table('role_permissions')->insert(['role' => $role, 'section' => 'password']);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
