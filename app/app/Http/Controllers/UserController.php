<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Exception;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ユーザ情報を変数に受け取る
        $user = Auth::user();
        // ビューに値を投げて画面を遷移する
        return view('home',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ユーザ情報を変数に受け取る
        $user = Auth::user();
        // 店舗情報を全て変数に受け取る
        $stores = Store::all();
        // ビューに情報を渡して遷移
        return response()->view('employeeRegistrationForm',[
            'user' => $user,
            'stores' => $stores
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
        // 手動トランザクションを開始
        DB::beginTransaction();
        try{
            // ユーザのインスタンスを生成
            $user = new User;
            // ユーザ名を格納
            $user->name = $request->name;
            // メールアドレスを格納
            $user->email = $request->email;
            // パスワードをハッシュ化
            $hashed_pass = Hash::make($request->pass);
            // ハッシュ化したパスワードを格納
            $user->password = $hashed_pass;
            // 店舗IDを格納
            $user->store_id = $request->store_id;
            // 格納したデータをDBに保存
            $user->save();
            // トランザクションをコミット
            DB::commit();
            // セッションにハッシュ化する前のパスワードを格納
            session(['raw_pass' => $request->pass]);
            // 登録完了画面に遷移
            return redirect()->route('user_confirm',['id' => $user->id]);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        // IDと一致するユーザ情報を変数に受け取る
        $employee = User::find($id);
        // ユーザ情報の店舗IDと一致する店舗情報を変数に受け取る
        $store = Store::find($employee->store_id);
        // ハッシュ化する前のパスワードを変数に受け取る
        $raw_pass = session('raw_pass');
        // ハッシュ化前のパスワードをセッションから削除
        session()->forget('raw_pass');
        // ビューに情報を渡して画面を遷移
        return view('employeeRegistrationConfirm',[
            'employee' => $employee,
            'store' => $store,
            'pass' => $raw_pass,
            'user' => Auth::user()
        ]);
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
        
    }

    /**
     * ログアウト処理を行うメソッド
     */ 

    public function logout(Request $request) {
        // ログアウト処理
        Auth::logout();
        // セッションを破棄
        $request->session()->invalidate();
        // トークンを発行
        $request->session()->regenerateToken();
        // ログイン画面に遷移
        return redirect('/');
    }
}
