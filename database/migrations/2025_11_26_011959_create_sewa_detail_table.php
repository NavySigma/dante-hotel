<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sewa_detail', function (Blueprint $table) {

            $table->bigIncrements('sewa_detail_id'); // PK AUTO_INCREMENT

            $table->unsignedBigInteger('sewa_detail_sewa_id');  // FK ke sewa
            $table->unsignedBigInteger('sewa_detail_kamar_id'); // FK ke kamar

            $table->string('sewa_detail_status', 50);           // varchar(50)
            $table->integer('sewa_detail_total');               // int(11)

            $table->timestamps(); // created_at dan updated_at (nullable)
        });
    }

    public function down()
    {
        Schema::dropIfExists('sewa_detail');
    }
};
