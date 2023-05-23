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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nomArticle')->nullable();
            $table->integer('quantite')->nullable();
            $table->integer('pu')->nullable();
            $table->integer('montant')->nullable();
            $table->string('notice')->nullable(); 
            $table->string('noticeDoc')->nullable(); 
            $table->string('garantie')->nullable(); 
            $table->string('tuto')->nullable(); 
            $table->string('reparation')->nullable(); 
            $table->string('autreModele')->nullable(); 
            $table->string('revente')->nullable(); 
            $table->string('categories')->nullable(); 
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('articles');
    }
};
