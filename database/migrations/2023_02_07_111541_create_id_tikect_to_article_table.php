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
        Schema::table('articles', function (Blueprint $table) {
              $table->unsignedBigInteger('ticket_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
             $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
             $table->foreign('ticket_id')->nullable()->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
             $table->dropForeign(['user_id']);
        });
    }
};
