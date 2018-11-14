<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_id')->index()->comment('网址id');
            $table->string('shorturl')->index()->comment('短网址');
            $table->string('referer')->nullable()->comment('来源');
            $table->string('user_agent')->nullable()->comment('UA');
            $table->ipAddress('ip_address')->nullable()->comment('IP地址');
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
        Schema::dropIfExists('logs');
    }
}
