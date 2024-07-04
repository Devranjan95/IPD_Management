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
        Schema::create('idproofs', function (Blueprint $table) {
            $table->id();
            $table->string('id_name');
            $table->string('id_code')->unique();
            $table->string('id_val_length');
            $table->enum('status',['Active','Inactive']);
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
        Schema::dropIfExists('idproofs');
    }
};
