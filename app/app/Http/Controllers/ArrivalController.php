<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArrival;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Arrival;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Store;

class ArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 入荷情報を格納する変数を宣言
        $arrival = null;
        // 検索されたかで分岐処理
        if (false) {

        } else {
            if (Auth::user()->role == 1) {  // 管理者の場合は全ての入荷情報を取得
                // 入荷情報をインスタンス生成
                $arrival = Arrival::all();
            } else {    // 一般社員の場合は所属店舗の入荷のみを取り出す
                // 入荷情報をインスタンス生成
                $arrival = Arrival::where('store_id', '=', Auth::user()->store_id)->with(['store', 'product'])->get();
            }
        }
        // ビューに情報を渡して画面遷移
        return response()->view('arrivalList', [
            'user' => Auth::user(),
            'arrivals' => $arrival
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 商品情報を変数に格納する
        $products = Product::all();
        // ビューに情報を渡して画面を遷移
        return response()->view('arrivalRegistration', [
            'user' => Auth::user(),
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateArrival $request)
    {
        // 手動トランザクションを開始
        DB::beginTransaction();
        try {
            // 入荷のインスタンスを生成
            $arrival = new Arrival;
            // 店舗IDを格納
            $arrival->store_id = Auth::user()->store_id;
            // 商品IDを格納
            $arrival->product_id = $request->product_id;
            // 入荷個数を格納
            $arrival->count = $request->count;
            // 入荷重量を格納
            $arrival->weight = $request->weight;
            // 入荷予定日を格納
            $arrival->date = $request->date;
            // 格納したデータをDBに保存
            $arrival->save();
            // トランザクションをコミット
            DB::commit();
            // 画面を遷移
            return redirect()->route('arrival_result', ['id' => $arrival->id]);
        } catch (Exception $e) {
            DB::rollBack();
            redirect()->route('arrival_list');
        }
    }

    // 入荷登録完了画面を表示するためのメソッド
    public function result($id)
    {
        // IDと一致する入荷情報を取得
        $arrival = Arrival::find($id);
        if ($arrival) {
            // 入荷情報と一致する商品情報を取得
            $product = Product::find($arrival->product_id);
            // ビューに情報を渡して画面を遷移
            return view('arrivalRegiResult', [
                'user' => Auth::user(),
                'arrival' => $arrival,
                'product' => $product,
            ]);
        } else {
            abort(404, '入荷情報が見つかりません。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        // IDと一致する入荷情報を取得
        $arrival = Arrival::find($id);
        if ($arrival) {
            // 入荷情報と一致する商品情報を取得
            $product = Product::find($arrival->product_id);
            // 入荷情報と一致する店舗情報を取得
            $store = Store::find($arrival->store_id);
            // ビューに情報を渡して画面遷移
            return view('arrivalDetail', [
                'user' => Auth::user(),
                'arrival' => $arrival,
                'product' => $product,
                'store' => $store
            ]);
        } else {
            abort(404, '入荷情報が見つかりません。');
        }
    }

    /**
     * 入荷情報を確定する処理を行うメソッド
     */
    public function confirm(Request $request)
    {
        // 選択された入荷情報を取得
        $arrival = Arrival::find($request->arrival_id);
        if ($arrival) {
            // 入荷情報の店舗IDと商品IDが一致する在庫情報があるか確認
            $stock = Stock::where('store_id', $arrival->store_id)
                ->where('product_id', $arrival->product_id)->first();
            DB::beginTransaction();
            if ($stock) {   // データベースに商品IDと店舗IDが一致する在庫が見つかった場合
                Stock::where('id', $stock->id)->increment('count', $arrival->count);
                Stock::where('id', $stock->id)->increment('weight', $arrival->weight);
            } else {    // データベースに商品IDと店舗iDが一致する在庫がない場合
                $stock = new Stock;
                $stock->store_id = $arrival->store_id;
                $stock->product_id = $arrival->product_id;
                $stock->count = $arrival->count;
                $stock->weight = $arrival->weight;
                $stock->save();
            }
            DB::commit();
            $stocks = Stock::where('id',$stock->id)->with(['product','store'])->first();
            Arrival::destroy($arrival->id);
            return view('arrivalFixing',[
                'user' => Auth::user(),
                'stock' => $stocks,
            ]);
        } else {
            abort(404, '入荷情報が見つかりません。');
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
