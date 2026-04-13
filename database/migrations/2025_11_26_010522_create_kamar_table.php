<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {

            $table->bigIncrements('kamar_id'); // PK AUTO_INCREMENT

            $table->unsignedBigInteger('kamar_kategori_id'); // FK kategori

            $table->string('kamar_nama', 255); // NOT NULL

            $table->integer('kamar_harga'); // int(11)

            $table->float('kamar_rating', 10, 2)->default(0.00); // float(10,2) default 0.00

            $table->integer('kamar_lantai'); // int(11)

            $table->string('kamar_no', 10)->default('A2.1'); // varchar(10) default A2.1

            $table->integer('kamar_kapasitas')->default(1); // int(11) default 1

            $table->string('kamar_img', 250)->nullable(); // NULL

            $table->timestamps(); // created_at & updated_at = NULL
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar');
    }
};
