<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', 1)->unsigned();
            $table->string('nickname',50);
            $table->string('username', 50)->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('school');
            $table->timestamp('last_login_time')->nullable();
            $table->timestamp('register_time')->nullable();
            $table->ipAddress('last_login_ip')->default('1.1.1.1');
            $table->integer('submit')->default(0);
            $table->integer('solved')->default(0);
            $table->integer('notification_count')->unsigned()->default(0);
            $table->string('avatar')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
