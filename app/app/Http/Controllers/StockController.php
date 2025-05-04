<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockDelete;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 在庫情報を格納する変数
        $stocks = null;
        // 検索されたかで分岐処理
        if ($request->input('search')) {
            $search = $request->input('search');
            if (Auth::user()->role == 1) {  // 管理者の場合は店舗名か商品名で検索
                // 全店舗の在庫から商品名か店舗名が一部分一致する在庫を一覧表示する
                $stocks = Stock::where(function ($query) use ($search) {
                    $query->whereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('store', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                })->get();
            } else {    // 一般社員の場合は所属店舗の商品名で検索
                $stocks = Stock::where('store_id', Auth::user()->store_id)
                    ->whereHas('product', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })->get();
            }
            // ビューに情報を渡して画面遷移
            return response()->view('inventory', [
                'user' => Auth::user(),
                'stocks' => $stocks,
                'search' => $search
            ]);
        } else {
            if (Auth::user()->role == 1) {  // 管理者の場合は全ての在庫情報を取り出す
                // 在庫情報をインスタンス生成
                $stocks = Stock::all();
            } else { // 一般社員の場合は所属店舗の在庫のみ取り出す
                // 在庫情報をインスタンス生成
                $stocks = Stock::where('store_id', Auth::user()->store_id)->with(['store', 'product'])->get();
            }
        }
        // ビューに情報を渡して画面遷移
        return response()->view('inventory', [
            'user' => Auth::user(),
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 選択した在庫の情報を取り出す
        $stock = Stock::where('id', '=', $request->input('id'))->with('store', 'product')->first();
        // ビューに情報を渡して画面遷移
        return response()->view('inventoryElimination', [
            'user' => Auth::user(),
            'stock' => $stock
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 受け取ったIDの在庫情報を変数に受け取る
        $stock = Stock::find($id);
        if ($stock) {
            if (Auth::user()->role == 1 || Auth::user()->store_id == $stock->store_id) {
                // 在庫の商品IDと一致する商品情報を受け取る
                $product = Product::find($stock->product_id);
                // 在庫の店舗IDと一致する店舗情報を受け取る
                $store = Store::find($stock->store_id);
                // ビューに情報を渡して画面遷移
                return response()->view('inventoryDetail', [
                    'stock' => $stock,
                    'product' => $product,
                    'store' => $store,
                    'user' => Auth::user()
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(StockDelete $request)
    {
        // 減算する値をキャスト
        $count = (int) $request->input('count');
        $weight = (int) $request->input('weight');
        $stock = Stock::find($request->input('id'));
        if ($stock->count < $count || $stock->weight < $weight) {
            abort(404, '無効な値が入力されました。');
        } else {
            DB::table('stocks')->where('id', '=', $request->input('id'))
                ->update([
                    'count' => DB::raw('count - ' . $count),
                    'weight' => DB::raw('weight - ' . $weight)
                ]);
            if ($stock->weight == 0 && $stock->count == 0) {
                $stock->delete();
                return redirect(route('stock_list'));
            }
            return redirect(route('stock_result'))
                ->with(['stock_id' => $request->input('id')]);
        }
    }

    public function result()
    {
        // セッションからストックIDを取得
        $id = session('stock_id');
        if ($id) {
            // IDが一致するストック情報を取り出す
            $stock = Stock::where('id', '=', $id)->with('product', 'store')->first();
            // ビューに情報を渡して画面遷移
            return response()->view('inventoryResult', [
                'user' => Auth::user(),
                'stock' => $stock
            ]);
        } else {
            redirect(route('stock_list'));
        }
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
