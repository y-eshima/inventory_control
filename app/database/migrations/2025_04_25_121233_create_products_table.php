<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // 商品IDを格納するカラム
            $table->bigIncrements('id');
            // 商品名を格納するカラム
            $table->string('name','100');
            // 商品画像のパスを格納するカラム
            $table->string('image','255')->nullable();
            // カテゴリーIDと紐づけるカラム
            $table->unsignedBigInteger('category_id');
            // カテゴリーIDと紐づけ
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
