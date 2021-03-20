<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('BoothID');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('BoothID')->references('id')->on('booths')->onDelete('cascade');
            $table->text('Text');
            $table->enum('Sender' , ['Visitor' , 'Exhibitor', 'Admin']);
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
        Schema::dropIfExists('chats');
    }
}
