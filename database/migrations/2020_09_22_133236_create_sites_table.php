<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->text('Description');
            $table->text('Logo1');
            $table->text('Logo2')->nullable();
            $table->text('Logo3')->nullable();
            $table->text('AdminBackground')->nullable();
            $table->text('Terms')->nullable();
            $table->string('AdminTel')->nullable();
            $table->string('AdminLocation')->nullable();
            $table->string('AdminAddress')->nullable();
            $table->text('SigninBackground')->nullable();
            $table->string('ExhabitionTitle')->nullable();
            $table->text('VisitorBackGround')->nullable();
            $table->text('VisitorWelcome')->nullable();
            $table->text('VisitorAbout')->nullable();
            $table->text('VisitorAboutPayment')->nullable();
            $table->text('VisitorPayment')->nullable();
            $table->text('VisitorGender')->nullable();
            $table->text('VisitorProfession')->nullable();
            $table->text('ExhibitorBackGround')->nullable();
            $table->text('ExhibitorWelcome')->nullable();
            $table->text('ExhibitorAbout')->nullable();
            $table->text('ExhibitorAboutPayment')->nullable();
            $table->text('ExhibitorPayment')->nullable();
            $table->text('ExhibitorGender')->nullable();
            $table->text('ExhibitorProfession')->nullable();
            $table->text('ExhibitorMaximumOperator')->nullable();
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
        Schema::dropIfExists('sites');
    }
}
