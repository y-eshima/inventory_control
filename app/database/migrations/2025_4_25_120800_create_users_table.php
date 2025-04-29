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
            // ユーザIDを格納するカラム
            $table->bigIncrements('id');
            // ユーザ名を格納するカラム
            $table->string('name','10');
            // メールアドレスを格納するカラム
            $table->string('email','30')->unique();
            // パスワードを格納するカラム
            $table->string('password','100');
            // 役職フラグを格納するカラム。一般=0,管理者=1
            $table->integer('role')->default(0);
            // 削除フラグを格納するカラム。デフォルトはfalse。論理削除時trueに書き換え
            $table->boolean('del_flg')->default(false);
            // 店舗IDと紐づけるカラム
            $table->unsignedBigInteger('store_id');
            // 店舗IDとの紐づけ
            $table->foreign('store_id')->references('id')->on('stores');
            // タイムスタンプを格納するカラム
            $table->timestamps();
            // パスワード再設定キーを格納するカラム
            $table->rememberToken()->nullable();
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
