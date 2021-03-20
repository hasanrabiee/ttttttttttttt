<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_requests', function (Blueprint $table) {
            $table->id();

            $table->integer('booth');
            $table->date('date1');
            $table->date('date2');
            $table->date('date3');
            $table->string('title');
            $table->text('abstract');


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
        Schema::dropIfExists('conference_requests');
    }
}
