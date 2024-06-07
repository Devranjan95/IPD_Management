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
            $table->string('bed_name', 20);
            $table->foreignId('bed_type_id')->references('id')->on('bed_types')->onDelete('cascade');
            $table->foreignId('bed_category_id')->references('id')->on('bed_categories')->onDelete('cascade');
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
        Schema::dropIfExists('beds');
    }
};
