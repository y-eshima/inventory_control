<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    // タイムスタンプを無効化
    public $timestamps = false;
    // 商品テーブルと紐づけ
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    //店舗テーブルと紐づけ
    public function store(){
        return $this->belongsTo('App\Models\Store','store_id','id');
    }

    public function getFormattedDateAttribute(){
        return Carbon::parse($this->attributes['date'])->format('Y年m月d日');
    }
}
