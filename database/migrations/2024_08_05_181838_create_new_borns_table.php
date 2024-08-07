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
        Schema::create('new_borns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('birth_record_id')->constrained('birthrecord')->onDelete('cascade');
            $table->date('birthdate');
            $table->time('birthtime');
            $table->string('placeofbirth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->decimal('weight', 5, 2);
            $table->decimal('length', 5, 1);
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_borns');
    }
};
