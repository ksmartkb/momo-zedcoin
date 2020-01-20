<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->increments('id');     
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('timeline_id')->unsigned();
            $table->float('shares_amount');
            $table->boolean('approve')->default(1);
            $table->string('type', 100);
            $table->timestamps();
            $table->softDeletes();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('shares');
    }
}
