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
        Schema::create('employees', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->string('name_en');
            $table->string('name_mm');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('race');
            $table->string('religion');
            $table->string('nationality');
            $table->string('vacancy');
            $table->string('passport_no');
            $table->string('driver_license');
            $table->string('genders');
            $table->string('blood');
            $table->string('marital_status');
            $table->string('hph_no')->unique();
            $table->string('ph_no')->unique();
            $table->string('url');
            $table->foreignUuid('nrcs_id')->constrained('nrcs');
            $table->string('type');
            $table->integer('nrc_num')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
