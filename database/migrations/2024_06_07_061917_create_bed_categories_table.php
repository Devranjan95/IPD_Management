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
        Schema::create('bed_categories', function (Blueprint $table) {
            $table->id();
            $table->string('bed_category',20)->unique();
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
        Schema::dropIfExists('bed_categories');
    }
};
