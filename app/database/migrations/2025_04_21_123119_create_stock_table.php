<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            // 在庫IDを格納するカラム
            $table->bigIncrements('id');
            // 店舗IDと紐づけるカラム
            $table->unsignedBigInteger('store_id');
            // 店舗IDと紐づけ
            $table->foreign('store_id')->references('id')->on('store');
            // 商品IDと紐づけるカラム
            $table->unsignedBigInteger('product_id');
            // 商品IDと紐づけ
            $table->foreign('product_id')->references('id')->on('product');
            // 商品在庫数を格納するカラム
            $table->integer('count')->default(0);
            // 商品在庫重量を格納するカラム
            $table->integer('weight')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
