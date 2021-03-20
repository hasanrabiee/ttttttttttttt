<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExhibitorsFormToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text("companyAddress")->nullable();
            $table->text("zipCode")->nullable();
            $table->text("mainCompany")->nullable();
            $table->text("institutionEmail")->nullable();
            $table->string("phone")->nullable();
            $table->string("fax")->nullable();
            $table->string("institution")->nullable();
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
            $table->dropColumn("companyAddress");
            $table->dropColumn("zipCode");
            $table->dropColumn("mainCompany");
            $table->dropColumn("institutionEmail");
            $table->dropColumn("phone");
            $table->dropColumn("fax");
            $table->dropColumn("institution");
        });
    }
}
