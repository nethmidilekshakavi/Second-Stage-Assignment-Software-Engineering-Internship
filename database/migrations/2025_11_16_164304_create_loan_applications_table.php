<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable();

            $table->string('name');
            $table->string('email')->index();
            $table->string('tel');
            $table->string('occupation');
            $table->decimal('salary', 12, 2)->default(0);
            $table->string('paysheet_uri')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
