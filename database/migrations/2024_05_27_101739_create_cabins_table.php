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
        Schema::create('cabins', function (Blueprint $table) {
            $table->id();
            $table->string('cabin_name', 15);
            $table->foreignId('cabin_type_id')->constrained('cabin_types')->onDelete('cascade');
            $table->foreignId('floor_id')->constrained('floors')->onDelete('cascade');
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade');
            $table->integer('total_occupancy');
            $table->integer('assigned')->nullable();
            $table->integer('available')->nullable();
            $table->string('amenities', 250);
            $table->integer('price');
            $table->enum('status', ['Active', 'Inactive', 'Deleted']);
            $table->text('narration')->nullable();
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
        Schema::dropIfExists('cabins');
    }
};
