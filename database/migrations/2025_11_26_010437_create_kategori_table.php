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
        Schema::create('kategori_kamar', function (Blueprint $table) {
            // Kolom 1: kategori_id (Primary Key, bigint(20) UNSIGNED, Auto Increment, Not Null)
            $table->bigIncrements('kategori_id'); 
            
            // Kolom 2: kategori_nama (varchar(255), Not Null)
            $table->string('kategori_nama', 255)->unique(); 
            
            // Kolom 3: kategori_deskripsi (varchar(255), Not Null)
            $table->string('kategori_deskripsi', 255); 
            
            // Kolom 4 & 5: created_at & updated_at (timestamp, Nullable)
            // Ini adalah kolom timestamp Laravel standar
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kamar');
    }
};