<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepositoryToPlaybooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playbooks', function (Blueprint $table) {
            $table->string('repository', 255)->default('default-CentOS7')->after('private_key');
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
            $table->dropColumn('repository');
        });
    }
}
