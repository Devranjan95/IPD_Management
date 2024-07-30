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
            $table->string('bedtype');
            $table->string('flag');
            $table->string('category_id');
            $table->string('type_name_id');
            $table->string('floor_count');
            $table->string('block_id');
            $table->string('type_price_24hr');
            $table->string('extra_amenity')->nullable();
            $table->string('amenity_start_date')->nullable();
            $table->string('amenity_end_date')->nullable();
            $table->string('adv_amount')->nullable();
            $table->string('date_of_addmission');
            $table->string('time_of_addmission');
            $table->string('emergency')->nullable();
            $table->string('treating_type')->nullable();
            $table->string('reffered_from')->nullable();
            $table->string('date_of_discharge')->nullable();
            $table->string('time_of_discharge')->nullable();
            $table->text('discharge_summary')->nullable();
            $table->string('total_stay_hr')->nullable();
            $table->string('total_price')->nullable();
            $table->string('status')->nullable();
            $table->string('deceased_status')->nullable();
            $table->string('maternity_status')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('patient_regn_no')->references('patient_regn_no')->on('patients')->onDelete('cascade');
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
