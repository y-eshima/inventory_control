<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;
    // 店舗テーブルと紐づけ
    public function store(){
        return $this->belongsTo('App\Models\Store','store_id','id');
    }

    // 商品テーブルと紐づけ
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
