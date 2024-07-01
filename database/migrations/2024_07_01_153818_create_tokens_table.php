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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('patient_regn_no');
            $table->string('token_no');
            $table->string('attendant_name');
            $table->string('attendant_phone');
            $table->string('bednumber');
            $table->string('type');
            $table->string('type_name');
            $table->string('type_price_24hr');
            $table->string('date_of_addmission');
            $table->string('time_of_addmission');
            $table->string('emergency')->nullable();
            $table->string('treating_type')->nullable();
            $table->string('reffered_from')->nullable();
            $table->string('date_of_discharge')->nullable();
            $table->string('time_of_discharge')->nullable();
            $table->string('total_stay_hr')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
