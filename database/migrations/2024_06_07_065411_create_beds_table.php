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
            $table->string('bed_name', 65);
            $table->foreignId('bed_type_id')->constrained('bed_types')->onDelete('cascade');
            $table->foreignId('bed_category_id')->constrained('bed_categories')->onDelete('cascade');
            $table->integer('no_of_beds');
            $table->integer('assigned_no')->nullable();
            $table->integer('available')->nullable();
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
