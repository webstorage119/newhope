<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_apply', function (Blueprint $table) {
            $table->integer('id', 1)->index()->unsigned();
            $table->integer('uid');
            $table->integer('team_id');
            $table->boolean('be_deal')->default(false);
            $table->timestamp('deal_time')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_apply');
    }
}
