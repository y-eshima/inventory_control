<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    // 書き込みを許可するホワイトリストを設定
    protected $fillable = ['name','email','password','del_flg','store_id','remember_token'];
    // 店舗テーブルと紐づけ
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
