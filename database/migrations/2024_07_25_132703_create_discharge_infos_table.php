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
        Schema::create('discharge_infos', function (Blueprint $table) {
            $table->id();
            $table->string('patient_regn_no');
            $table->string('patient_name');
            $table->string('contact');
            $table->string('clearance');
            $table->enum('patient_status',['New Born','Living','Deceased']);
            $table->string('date_of_discharge')->nullable();
            $table->string('time_of_discharge')->nullable();
            $table->text('discharge_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discharge_infos');
    }
};
