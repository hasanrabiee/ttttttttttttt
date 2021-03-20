<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHelpToSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->text("visitorRegistrationVideo")->nullable();
            $table->text("visitorRegistrationPDF")->nullable();
            $table->text("visitorPanelVideo")->nullable();
            $table->text("visitorPanelPDF")->nullable();

            $table->text("exRegistrationVideo")->nullable();
            $table->text("exRegistrationPDF")->nullable();
            $table->text("exPanelVideo")->nullable();
            $table->text("exPanelPDF")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn("visitorRegistrationVideo");
            $table->dropColumn("visitorRegistrationPDF");
            $table->dropColumn("visitorPanelVideo");
            $table->dropColumn("visitorPanelPDF");


            $table->dropColumn("exRegistrationVideo");
            $table->dropColumn("exRegistrationPDF");
            $table->dropColumn("exPanelVideo");
            $table->dropColumn("exPanelPDF");
        });
    }
}
