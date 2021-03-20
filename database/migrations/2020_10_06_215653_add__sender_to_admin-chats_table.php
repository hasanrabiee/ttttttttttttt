<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSenderToAdminChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `admin_chats` MODIFY `Sender` ENUM('Visitor' , 'Exhibitor','Exhibitor-Operator','Admin-Operator', 'Admin')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `admin_chats` MODIFY `Sender` ENUM('Visitor' , 'Exhibitor', 'Admin')");
    }
}
