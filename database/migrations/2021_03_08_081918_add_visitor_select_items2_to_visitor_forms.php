<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisitorSelectItems2ToVisitorForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitor_forms', function (Blueprint $table) {
            $table->string("cityItems")->nullable();
            $table->string("countryInterestedItems")->nullable();
            $table->string("onlineDegreeProgramsItems")->nullable();
            $table->string("admissionSemesterItems")->nullable();
            $table->string("professionInterestedItems")->nullable();
            $table->string("profileItems")->nullable();
            $table->enum("studentStatus",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("jobSeekerStatus",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("companyStatus",["active","DeActive"])->default("DeActive")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitor_forms', function (Blueprint $table) {
            $table->dropColumn("cityItems");
            $table->dropColumn("countryInterestedItems");
            $table->dropColumn("onlineDegreeProgramsItems");
            $table->dropColumn("admissionSemesterItems");
            $table->dropColumn("professionInterestedItems");
            $table->dropColumn("profileItems");
        });
    }
}
