<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_forms', function (Blueprint $table) {
            $table->id();
            $table->enum("education",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("countryStudy",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("InterestedDegree",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("InterestedField",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("languageOfStudy",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("onlineDegreeProgram",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("interestedScholarShip",["active","DeActive"])->default("DeActive")->nullable();
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
        Schema::dropIfExists('visitor_forms');
    }
}
