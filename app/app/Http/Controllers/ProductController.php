<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduct;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // カテゴリー情報をインスタンス生成
        $categories = Category::all();
        // ビューにカテゴリー情報を渡して画面遷移
        return response()->view('productRegistrationForm', [
            'user' => Auth::user(),
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $request)
    {
        // 手動トランザクションを設定
        DB::beginTransaction();
        try {
            // リクエストから画像ファイルを変数に取得
            $image = $request->file('image');
            // 画像ファイルがあればStorageに保存
            if ($request->hasFile('image')) {
                $path = \Storage::put('/public', $image);
                $path = explode('/', $path);
            } else {
                $path = null;
            }
            // 商品情報のインスタンスを生成
            $product = new Product;
            // 商品名を格納
            $product->name = $request->product_name;
            // カテゴリーIDを格納
            $product->category_id = $request->category_id;
            // 商品画像のパスを格納
            $product->image = $path ? $path[1] : null;
            // 商品情報をデータベースに格納
            $product->save();
            // トランザクションをコミット
            DB::commit();
            // 登録完了画面に遷移
            return redirect()->route('product_confirm', ['id' => $product->id]);
        } catch (Exception $e) {
            // 問題が発生した場合はロールバック
            DB::rollBack();
            // 画像をアップロードしていた場合は削除
            if ($path) {
                \Storage::delete('/public/' . $path[1]);
            }
            // 商品情報登録フォームに遷移
            return response()->view('productRegistrationForm', [
                'message' => '商品情報の登録に失敗しました。'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        // IDが一致する商品情報を変数に受け取る
        $product = Product::find($id);
        // 商品情報のカテゴリーIDと一致するカテゴリー情報を変数に受け取る
        $category = Category::find($product->category_id);
        // ビューに情報を渡して画面遷移
        return view('productConfirm', [
            'product' => $product,
            'category' => $category,
            'user' => Auth::user()
        ]);
    }
    // Ajaxでモーダルを表示するためのメソッド
    public function ajaxDetail(Request $request)
    {
        // 受け取った商品IDと一致する商品の情報を取得
        $product = Product::find($request->input('productId'));
        // 商品情報が見つからなければ404エラー画面を出力
        if (!$product) {
            return response()->json(['error' => '商品が見つかりません。'], 404);
        } else {
            // 商品情報と合致するカテゴリー情報を取り出す
            $category = Category::find($product->category_id);
            // ユーザ情報を出力
            $user = Auth::user();
            // 情報をレンダリング
            $html = view('partials.product_detail_modal', compact('product', 'category', 'user'))->render();
            return response()->json(['doc' => $html]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
