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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('identifiant')->unique()->nullable();
            $table->string('password');
            $table->string('code_postal');
            $table->string('code')->nullable();
            $table->string('validation')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }
    
    
      protected $hidden = [
                'password',
        ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
