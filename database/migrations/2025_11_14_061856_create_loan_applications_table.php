<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_applications', function (Blueprint $table) {
    $table->id(); // auto-increment primary key
    $table->string('name');
    $table->string('email');
    $table->string('tel');
    $table->string('occupation');
    $table->decimal('salary', 10,2);
    $table->string('paysheet_uri')->nullable();
    $table->string('status')->default('pending');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
