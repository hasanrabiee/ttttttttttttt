<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepHasanToBooths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booths', function (Blueprint $table) {
            Schema::table('booths', function (Blueprint $table) {
                $table->enum('StepTwo' , ['Passed' , 'Waiting'])->default('Passed');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booths', function (Blueprint $table) {
            Schema::table('booths', function (Blueprint $table) {
                $table->dropColumn("StepTwo");
            });
        });
    }
}
