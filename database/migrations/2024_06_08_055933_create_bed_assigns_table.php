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
            $table->string('floor',25);
            $table->string('block',30);
            $table->json('bed_no');  // Changed to JSON type
            $table->string('bed_name',70)->nullable();
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
