<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
// 一般と管理者両方に表示する画面
Route::middleware(['auth'])->group(function () {
    // ホーム画面を表示するルート
    Route::get('/', [UserController::class,'index'])->name('home');
    // ログアウトするルート
    Route::post('/logout', [UserController::class,'logout'])->name('logout');
    // 在庫管理関係
    Route::prefix('inventory')->group(function(){
        Route::get('/list',[StockController::class,'index'])->name('stock_list');
        Route::get('/detail{id}',[StockController::class,'show'])->name('stock_detail');
        Route::post('/form',[StockController::class,'create'])->name('stock_form');
        Route::post('/delete',[StockController::class,'update'])->name('stock_delete');
        Route::get('/result',[StockController::class,'result'])->name('stock_result');
    });
});
// 管理者にのみ表示を許可する画面
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 商品情報登録グループ
    Route::prefix('product')->group(function () {
        Route::get('/create', [ProductController::class,'create'])->name('product_form');
        Route::post('/store',[ProductController::class,'store'])->name('product_store');
        Route::get('/confirm/{id}',[ProductController::class,'show'])->name('product_confirm');
    });
    // 社員情報登録グループ
    Route::prefix('employee')->group(function (){
        Route::get('/create',[UserController::class,'create'])->name('user_create');
        Route::post('/store',[UserController::class,'store'])->name('user_store');
        Route::get('/confirm/{id}',[UserController::class,'show'])->name('user_confirm');
    });
});

