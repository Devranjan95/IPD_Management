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
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_no',5);
            $table->string('bed_type',15);
            $table->string('bed_code',8);
            $table->foreignId('floor_id')->nullable()->constrained('floors')->onDelete('cascade');
            $table->foreignId('block_id')->nullable()->constrained('blocks')->onDelete('cascade');
            $table->enum('cabin',['yes','no']);
            $table->foreignId('cabin_type_id')->nullable()->constrained('cabin_types')->onDelete('cascade');
            $table->foreignId('cabin_id')->nullable()->constrained('cabins')->onDelete('cascade');
            $table->enum('ward',['yes','no']);
            $table->foreignId('ward_type_id')->nullable()->constrained('ward_types')->onDelete('cascade');
            $table->foreignId('ward_id')->nullable()->constrained('wards')->onDelete('cascade');
            $table->enum('icu',['yes','no']);
            $table->foreignId('icu_type_id')->nullable()->constrained('icu_types')->onDelete('cascade');
            $table->foreignId('icu_id')->nullable()->constrained('icu')->onDelete('cascade');
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
        Schema::dropIfExists('beds');
    }
};
