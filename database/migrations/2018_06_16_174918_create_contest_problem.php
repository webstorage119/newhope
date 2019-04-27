<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestProblem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_problem', function (Blueprint $table) {
            $table->integer('id', 1)->index()->unsigned();
            $table->integer('cid')->unsigned()->index();
            $table->integer('pid')->unsigned()->index();
            $table->integer('keychar');
            $table->string('color')->default("white");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_problem');
    }
}
