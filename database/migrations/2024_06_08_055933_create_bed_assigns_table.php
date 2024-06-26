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
            $table->string('type',20);
            $table->string('type_name',30);
            $table->string('type_id',3);
            $table->string('floor_count',25);
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade');;
            $table->string('bed_no',30);  // Changed to JSON type
            $table->string('bed_name',70);
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
