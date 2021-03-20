<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitorFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitor_forms', function (Blueprint $table) {
            $table->id();
            $table->enum("firstName",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("lastName",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("position",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("companyAddress",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("city",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("zipCode",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("country",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("website",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("mainCompany",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("institutionEmail",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("phone",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("mob",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("fax",["active","DeActive"])->default("DeActive")->nullable();
            $table->enum("institution",["active","DeActive"])->default("DeActive")->nullable();
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
        Schema::dropIfExists('exhibitor_forms');
    }
}
