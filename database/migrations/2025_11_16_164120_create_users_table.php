<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Skip creation if the table already exists (prevents duplicate-create errors)
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('mobile_number')->nullable();
                $table->text('address')->nullable();
                $table->string('nic_front_image')->nullable();
                $table->string('nic_back_image')->nullable();
                $table->string('passport_image')->nullable();
                $table->enum('role', ['user', 'manager', 'admin'])->default('user');
                $table->boolean('profile_completed')->default(false);
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::dropIfExists('users');
        }
    }
};
