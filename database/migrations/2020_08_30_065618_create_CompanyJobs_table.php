<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CompanyJobs', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('Description');
            $table->integer('Number');
            $table->string('Salary')->nullable();
            $table->unsignedBigInteger('BoothID');
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
        Schema::dropIfExists('jobs');
    }
}
