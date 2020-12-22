<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaybooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playbooks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 255)->nullable()->default(null);
            $table->longText('inventory')->nullable();
            $table->longText('main')->nullable();
            $table->longText('vars')->nullable();
            $table->longText('private_key')->nullable();
            $table->tinyInteger('enable_flag')->default(0);
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
        Schema::dropIfExists('playbooks');
    }
}
