<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisitorFormToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("education")->nullable();
            $table->string("countryStudy")->nullable();
            $table->string("InterestedDegree")->nullable();
            $table->string("InterestedField")->nullable();
            $table->string("languageOfStudy")->nullable();
            $table->string("onlineDegreeProgram")->nullable();
            $table->string("interestedScholarShip")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("education");
            $table->dropColumn("countryStudy");
            $table->dropColumn("InterestedDegree");
            $table->dropColumn("InterestedField");
            $table->dropColumn("languageOfStudy");
            $table->dropColumn("onlineDegreeProgram");
            $table->dropColumn("interestedScholarShip");
        });
    }
}
