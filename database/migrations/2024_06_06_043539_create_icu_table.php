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
        Schema::create('icu', function (Blueprint $table) {
            $table->id();
            $table->string('icu_name',15);
            $table->foreignId('icu_type_id')->references('id')->on('icu_types')->onDelete('cascade');
            $table->foreignId('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->foreignId('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->string('occupancy',3);
            $table->string('amenities',250);
            $table->integer('price');
            $table->enum('status',['Active','Inactive','Deleted']);
            $table->text('narration')->nullable(); // Adding the narration field
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icu');
    }
};
