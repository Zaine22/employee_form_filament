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
        Schema::create('nrc_nos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('nrc_code')->constrained('nrcs')->cascadeOnDelete();
            $table->foreignId('name_en')->constrained('nrcs')->cascadeOnDelete();
            $table->integer('nrc_num')->unique();
            $table->enum('type', ['N', 'P', 'A'])
                ->default('N');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nrc_nos');
    }
};
