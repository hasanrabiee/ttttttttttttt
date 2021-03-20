<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('City');
            $table->string('Country');
            $table->enum('Payment',['Paid' , 'UnPaid'])->default('UnPaid');
            $table->date('BirthDate')->nullable();
            $table->unsignedBigInteger('CompanyID')->nullable();
            $table->foreign('CompanyID')->references('id')->on('booths')->onDelete('cascade');
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
            $table->dropColumn('City');
            $table->dropColumn('Country');
            $table->dropColumn('Payment');
            $table->dropColumn('BirthDate');
            $table->dropForeign('CompanyID');
            $table->dropColumn('CompanyID');
        });
    }
}
