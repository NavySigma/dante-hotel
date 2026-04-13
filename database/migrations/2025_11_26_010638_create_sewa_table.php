<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sewa', function (Blueprint $table) {

            $table->bigIncrements('sewa_id'); // PK AUTO_INCREMENT

            $table->unsignedBigInteger('sewa_user_id'); // FK user

            $table->date('sewa_tglcheckin'); // NOT NULL
            $table->date('sewa_tglcheckout')->nullable(); // NULL

            $table->text('sewa_note')->nullable(); // NULL

            $table->integer('sewa_denda')->default(0); // int(11) DEFAULT 0

            $table->enum('sewa_metode', [
                'Tunai', 
                'Transfer Bank', 
                'E-Wallet'
            ]); // ENUM NOT NULL

            $table->integer('sewa_lamamenginap')->nullable(); // NULL

            $table->timestamps(); // created_at & updated_at = NULL
        });
    }

    public function down()
    {
        Schema::dropIfExists('sewa');
    }
};
