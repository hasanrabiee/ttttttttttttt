<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();


            $table->string('owner_id');

            $table->string('title');

            $table->dateTime('start_time');


            $table->enum('type', ['meeting','webinar'])->default('meeting');

            $table->string('password');



            $table->string('meeting_id');



            $table->boolean('is_finished');
            $table->boolean('is_started');
            $table->boolean('is_active');


            $table->boolean('reserved')->default(false);
            $table->integer('reserved_by')->default(0);







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
        Schema::dropIfExists('meetings');
    }
}
