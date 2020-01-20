<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socialfund', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('group_user')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_user', function (Blueprint $table) {
            $table->foreign('socialfund_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_follows', function (Blueprint $table) {
            $table->foreign('share_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_follows', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_likes', function (Blueprint $table) {
            $table->foreign('socialfund_id')->references('id')->on('socialfund')
                        ->onDelete('restrict') 
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_media', function (Blueprint $table) {
            $table->foreign('socialfund_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_media', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_shares', function (Blueprint $table) {
            $table->foreign('share_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_shares', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_reports', function (Blueprint $table) {
            $table->foreign('socialfund_id')->references('id')->on('socialfund')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('socialfund_reports', function (Blueprint $table) {
            $table->foreign('reporter_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
