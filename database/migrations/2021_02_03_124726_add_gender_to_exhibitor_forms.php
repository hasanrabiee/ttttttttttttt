<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToExhibitorForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exhibitor_forms', function (Blueprint $table) {
            $table->enum("gender",["active","DeActive"])->default("DeActive")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exhibitor_forms', function (Blueprint $table) {
            $table->dropColumn("gender");
        });
    }
}
