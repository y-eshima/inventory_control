<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            // ユーザIDを格納するカラム
            $table->bigIncrements('id');
            // ユーザ名を格納するカラム
            $table->string('name','10');
            // メールアドレスを格納するカラム
            $table->string('mail','30');
            // パスワードを格納するカラム
            $table->string('pass','100');
            // 役職フラグを格納するカラム 一般=0,管理者=1
            $table->integer('role')->default(0);
            // 削除フラグを格納するカラム 削除するときにtrueに書き換え
            $table->boolean('del_flg')->default(false);
            // 店舗IDと紐づけるカラム
            $table->unsignedBigInteger('store_id');
            // 紐づけ
            $table->foreign('store_id')->references('id')->on('store');
            // 作成日、更新日を格納するカラム
            $table->timestamps();
            // パスワード再設定キーを格納するカラム,nullを許容
            $table->string('remember_token','100')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
