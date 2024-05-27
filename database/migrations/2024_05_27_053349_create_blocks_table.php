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
            Schema::create('blocks', function (Blueprint $table) {
                $table->id();
                $table->string('block_name',3);
                $table->string('block_code',3)->unique();
                $table->foreignId('floor_id')->references('id')->on('floors')->onDelete('cascade');
                $table->enum('status',['Active','Inactive','Deleted']);
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
        Schema::dropIfExists('blocks');
    }
};
