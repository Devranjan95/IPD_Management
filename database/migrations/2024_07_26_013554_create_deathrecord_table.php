<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deathrecord', function (Blueprint $table) {
            $table->id();
            $table->string('patient_regn_no');
            $table->string('patient_name');
            $table->string('contact_no');
            $table->string('adhr_no');
            $table->string('attendant_name');
            $table->date('date_of_death');
            $table->time('time_of_death');
            $table->string('place_of_death');
            $table->string('cause_of_death');
            $table->integer('age');
            $table->string('image_path')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('address');
            $table->enum('marital_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('spouse_name')->nullable();
            $table->string('issued_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('death_records');
    }
}
