<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booths', function (Blueprint $table) {
            $table->id();
            $table->enum('Type',['A','B','C','D'])->nullable();
            $table->string('Position')->nullable();
            $table->string('Color1')->nullable();
            $table->string('Color2')->nullable();
            $table->string('HeaderName','25')->nullable();
            $table->string('HeaderColor')->nullable();
            $table->text('Poster1')->nullable();
            $table->text('Poster2')->nullable();
            $table->text('Poster3')->nullable();
            $table->text('Logo')->nullable();
            $table->integer('Hall')->nullable();
            $table->string('WebSite' ,35)->nullable();
            $table->string('WebSiteColor')->nullable();
            $table->string('Representative');
            $table->string('CompanyName')->unique();
            $table->text('Video')->nullable();
            $table->text('Doc1')->nullable();
            $table->enum('Status' , ['Active' , 'DeActive'])->default('DeActive');
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->on('users')->references('id')->onDelete('cascade');


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
        Schema::dropIfExists('booths');
    }
}
