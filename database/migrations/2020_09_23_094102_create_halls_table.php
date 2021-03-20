<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->text('Loby1')->nullable();
            $table->text('Loby2')->nullable();
            $table->text('Loby3')->nullable();
            $table->text('Loby4')->nullable();
            $table->text('Main1')->nullable();
            $table->text('Main2')->nullable();
            $table->text('Main3')->nullable();
            $table->text('Main4')->nullable();
            $table->text('Main5')->nullable();
            $table->text('Main6')->nullable();
            $table->text('Auditorium1')->nullable();
            $table->text('Auditorium2')->nullable();
            $table->text('Lounge1')->nullable();
            $table->text('Lounge2')->nullable();
            $table->text('Billboard1')->nullable();
            $table->text('Billboard2')->nullable();
            $table->text('Billboard3')->nullable();
            $table->text('Billboard4')->nullable();
            $table->text('Billboard5')->nullable();
            $table->text('Billboard6')->nullable();
            $table->text('Stand1')->nullable();
            $table->text('Stand2')->nullable();
            $table->text('Stand3')->nullable();
            $table->text('Stand4')->nullable();
            $table->text('Stand5')->nullable();
            $table->text('Stand6')->nullable();
            $table->text('Stand7')->nullable();
            $table->text('Wallposter1')->nullable();
            $table->text('Wallposter2')->nullable();
            $table->text('Wallposter3')->nullable();
            $table->text('Wallposter4')->nullable();
            $table->text('Wallposter5')->nullable();
            $table->text('Wallposter6')->nullable();
            $table->text('Wallposter7')->nullable();
            $table->text('Wallposter8')->nullable();

            $table->text('Rotationposter1')->nullable();
            $table->text('Rotationposter2')->nullable();
            $table->text('Rotationposter3')->nullable();
            $table->text('Rotationposter4')->nullable();

            $table->text('Rotationposter5')->nullable();
            $table->text('Rotationposter6')->nullable();
            $table->text('Rotationposter7')->nullable();
            $table->text('Rotationposter8')->nullable();


            $table->text('Rotationposter9')->nullable();
            $table->text('Rotationposter10')->nullable();
            $table->text('Rotationposter11')->nullable();
            $table->text('Rotationposter12')->nullable();



            $table->text('Rotationposter13')->nullable();
            $table->text('Rotationposter14')->nullable();
            $table->text('Rotationposter15')->nullable();
            $table->text('Rotationposter16')->nullable();


            $table->text('Rotationposter17')->nullable();
            $table->text('Rotationposter18')->nullable();
            $table->text('Rotationposter19')->nullable();
            $table->text('Rotationposter20')->nullable();



            $table->text('Rotationposter21')->nullable();
            $table->text('Rotationposter22')->nullable();
            $table->text('Rotationposter23')->nullable();
            $table->text('Rotationposter24')->nullable();



            $table->text('Panposter1')->nullable();
            $table->text('Panposter2')->nullable();
            $table->text('Panposter3')->nullable();
            $table->text('Text1')->nullable();
            $table->text('Text2')->nullable();
            $table->text('Text3')->nullable();

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
        Schema::dropIfExists('halls');
    }
}
