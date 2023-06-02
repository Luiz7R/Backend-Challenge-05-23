<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apidetails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('memoria_consumida');
            $table->string('tempo_execucao');
            $table->string('status');
            $table->date('data_importacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apidetails');
    }
};
