<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStreamdataToSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->string('RtmpAddress')->nullable();
            $table->string('StreamKey')->nullable();
            $table->string('PlaybackUrl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_sites', function (Blueprint $table) {
            $table->dropColumn('RtmpAddress');
            $table->dropColumn('StreamKey');
            $table->dropColumn('PlaybackUrl');
        });
    }
}
