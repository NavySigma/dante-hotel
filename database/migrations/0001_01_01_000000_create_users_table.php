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
        Schema::create('users', function (Blueprint $table) {
            // Kolom 1: user_id (Primary Key, bigint(20) UNSIGNED, Auto Increment, Not Null)
            $table->bigIncrements('user_id'); 
            
            // Kolom 2: user_profile (varchar(255), Nullable)
            $table->string('user_profile', 255)->nullable(); 
            
            // Kolom 3: user_namalengkap (varchar(255), Nullable)
            $table->string('user_namalengkap', 255)->nullable(); 
            
            // Kolom 4: user_nik (varchar(255), Not Null)
            $table->string('user_nik', 255)->unique(); 
            
            // Kolom 5: user_nohp (varchar(255), Not Null)
            $table->string('user_nohp', 255); 
            
            // Kolom 6: user_tglahir (date, Nullable)
            $table->date('user_tglahir')->nullable(); 
            
            // Kolom 7: user_username (varchar(255), Not Null, Unique)
            $table->string('user_username', 255)->unique(); 
            
            // Kolom 8: user_password (varchar(255), Not Null)
            $table->string('user_password', 255); 
            
            // Kolom 9: user_level (tinyint(1), Not Null, Default 0)
            $table->tinyInteger('user_level')->default(0); 
            
            // Kolom 10 & 11: created_at & updated_at (timestamp, Nullable)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};