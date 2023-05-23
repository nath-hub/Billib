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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('nom_magasin')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('numero')->nullable();
            $table->string('adresse')->nullable();
            $table->string('caissiere')->nullable();
            $table->integer('net')->nullable();
            $table->integer('tva')->nullable();
            $table->integer('total_payer')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
