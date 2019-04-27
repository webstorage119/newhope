<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->integer('id', 1)->unsigned();
            $table->string('title',100);
            $table->text('body');
            $table->string('username')->index('username');
            $table->integer('pid')->index('pid');
            $table->integer('cid')->index('cid')->nullable();
            $table->integer('reply_count')->index('reply_count')->default(0);
            $table->integer('view_count')->index('view_count')->default(0);
            $table->string('last_reply_username');
            $table->timestamp('last_reply_time');
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('topics');
    }
}
