<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // タイムスタンプを無効化
    public $timestamps = false;
    // 書き込みを許可するホワイトリストを設定
    protected $fillable = ['name','image','category_id'];
    // カテゴリーテーブルと紐づけ
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}
