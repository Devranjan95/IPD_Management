<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthrecord', function (Blueprint $table) {
            $table->id();
            $table->string('recordid')->nullable();
            $table->string('regn')->nullable();
            $table->string('patname');
            $table->string('contact');
            $table->date('birthdate');
            $table->time('birthtime');
            $table->string('placeofbirth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->decimal('weight', 5, 2);
            $table->decimal('length', 5, 1);
            $table->string('fathername');
            $table->string('mothername');
            $table->string('fatheradhar');
            $table->string('motheradhar');
            $table->text('address');
            $table->enum('maritalstatus', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('image_path')->nullable();
            $table->string('issuedby');
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
        Schema::dropIfExists('birth_records');
    }
}
