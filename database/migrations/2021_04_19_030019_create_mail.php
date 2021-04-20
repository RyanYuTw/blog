<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail', function (Blueprint $table) {
            $table->id()->comment("編號");
            $table->string("service_code", 10)->comment("服務對應碼");
            $table->string("from_name", 100)->nullable()->comment("寄件人姓名");
            $table->string("from_mail", 255)->comment("寄件人電子郵件");
            $table->text("to_name")->nullable()->comment("收件人姓名");
            $table->text("to_mail")->comment("收件人電子郵件");
            $table->string("subject", 255)->nullable()->comment("主旨");
            $table->text("body")->nullable()->comment("內容");
            $table->tinyInteger("send_status")->default(0)->comment("發送狀態 (0:未發送, 1:發送成功, -1:發送失敗)");
            $table->timestamps();

            $table->index(["service_code", "from_mail", "send_status"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail');
    }
}
