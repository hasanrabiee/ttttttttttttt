<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('UserName')->unique();
            $table->string('password');
            $table->string('SpeechTitle');
            $table->date('PreferredDate1')->nullable();
            $table->date('PreferredDate2')->nullable();
            $table->date('PreferredDate3')->nullable();
            $table->enum('Status', ['Selected' , 'None'])->default('None');
            $table->unsignedBigInteger('BoothID')->unique()->nullable();
            $table->foreign('BoothID')->on('booths')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('speakers');
    }
}
