<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLobyLinksToHalls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->string("lobyLink1")->nullable();
            $table->string("lobyLink2")->nullable();
            $table->string("lobyLink3")->nullable();
            $table->string("lobyLink4")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn("lobyLink1");
            $table->dropColumn("lobyLink2");
            $table->dropColumn("lobyLink3");
            $table->dropColumn("lobyLink4");
        });
    }
}
