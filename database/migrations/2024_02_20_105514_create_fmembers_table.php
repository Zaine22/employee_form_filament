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
        Schema::create('fmembers', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->string('name');
            $table->string('relationship');
            $table->date('date_of_birth');
            $table->string('occupation');
            $table->string('ph_no');
            $table->string('address');
            $table->foreignUuid('employee_id')->constrained('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fmembers');
    }
};
