<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_user', function (Blueprint $table) {
            $table->integer('id', 1)->index()->unsigned();
            $table->integer('cid')->unsigned()->index();
            $table->integer('uid')->unsigned()->index();
            $table->integer('team_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_user');
    }
}
