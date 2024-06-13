<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGptAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpt_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_email')->nullable()->comment('账号邮箱');
            $table->unsignedTinyInteger('state')->default('0')->nullable()->comment('禁用');
            $table->string('account_password')->nullable()->comment('账号密码');
            $table->string('account_session')->nullable()->comment('账号session');
            $table->text('last_error')->nullable()->comment('错误信息');
            $table->dateTime('last_message_at')->nullable()->comment('消息时间');
            $table->unsignedInteger('message_count')->default('0')->nullable()->comment('消息数');
            $table->unsignedTinyInteger('gpt4')->default('0')->nullable()->comment('支持gpt4');
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
        Schema::dropIfExists('gpt_account');
    }
}
