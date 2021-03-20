<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecondpartToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("currentLevelOfEducation")->nullable();
            $table->string("position")->nullable();
            $table->string("admissionSemester")->nullable();
            $table->string("professionInterestedToApply")->nullable();
            $table->string("organization")->nullable();
            $table->string("InterNationalPrograms")->nullable();
            $table->string("website")->nullable();
            $table->string("tel")->nullable();
            $table->string("userCompanyName")->nullable();
            $table->string("profile")->nullable();
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
            $table->dropColumn("currentLevelOfEducation");
            $table->dropColumn("position");
            $table->dropColumn("admissionSemester");
            $table->dropColumn("professionInterestedToApply");
            $table->dropColumn("organization");
            $table->dropColumn("InterNationalPrograms");
            $table->dropColumn("website");
            $table->dropColumn("tel");
            $table->dropColumn("userCompanyName");
            $table->dropColumn("profile");
        });
    }
}
