<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->integer('id', 1)->unsigned();
            $table->string('title', 100);

            $table->text('description')->nullable();
            $table->text('input')->nullable();
            $table->text('output')->nullable();
            $table->text('sample_input')->nullable();
            $table->text('sample_output')->nullable();
            $table->text('hint')->nullable();
            $table->text('source')->nullable();

            $table->string('v_name')->default('CUGB');
            $table->string('author', 100)->nullable();
            $table->boolean('hide')->default(0);
            $table->boolean('special_judge')->default(0);

            //暂时没有发挥作用
            $table->unsignedInteger('time_limit')->nullable()->default(1000);
            $table->unsignedInteger('case_time_limit')->nullalbe()->default(1000);
            $table->unsignedInteger('memory_limit')->nullable()->default(65535);

            //暂时没有发挥作用
            $table->unsignedInteger('total_ac')->nullable()->default(0);
            $table->unsignedInteger('total_submit')->nullable()->default(0);
            $table->unsignedInteger('total_ac_user')->nullable()->default(0);
            $table->unsignedInteger('total_submit_user')->nullable()->default(0);
            $table->unsignedInteger('total_wa')->nullable()->default(0);
            $table->unsignedInteger('total_re')->nullable()->default(0);
            $table->unsignedInteger('total_ce')->nullable()->default(0);
            $table->unsignedInteger('total_tle')->nullable()->default(0);
            $table->unsignedInteger('total_mle')->nullable()->default(0);
            $table->unsignedInteger('total_pe')->nullable()->default(0);
            $table->unsignedInteger('total_ole')->nullable()->default(0);
            $table->unsignedInteger('total_rf')->nullable()->default(0);

            
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
        Schema::dropIfExists('problems');
    }
}
