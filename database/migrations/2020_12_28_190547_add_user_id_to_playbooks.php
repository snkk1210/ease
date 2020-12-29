<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPlaybooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playbooks', function (Blueprint $table) {
            $table->Integer('owner_id')->nullable()->after('enable_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playbooks', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }
}
