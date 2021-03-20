<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->enum('Status',['New','Viewed'])->default('New');
        });
        Schema::table('admin_chats', function (Blueprint $table) {
            $table->enum('Status',['New','Viewed'])->default('New');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat', function (Blueprint $table) {
            $table->dropColumn('Status');
        });
        Schema::table('admin_chats', function (Blueprint $table) {
            $table->dropColumn('Status');
        });
    }
}
