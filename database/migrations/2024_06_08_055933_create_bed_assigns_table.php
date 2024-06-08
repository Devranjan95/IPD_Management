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
        Schema::create('bed_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('bed_no',12);
            $table->string('bed_code',12)->unique();
            $table->foreignId('bed_name_id')->references('id')->on('beds')->onDelete('cascade');
            $table->foreignId('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->foreignId('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->enum('assigned_to',['Cabin','Ward','Icu']);
            $table->string('assigned_type',20);
            $table->string('assigned_name',20);
            $table->date('assigned_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_assigns');
    }
};
