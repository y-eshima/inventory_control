<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * パスワードリセットフォームを表示
     */
    public function showResetForm($token, $email)
    {
        if ($token && $email) {
            return view('auth.reset')->with(['token' => $token, 'email' => $email]);
        } else {
            abort(404);
        }

    }

    /**
     * パスワードリセット処理
     */
    public function reset(Password $request)
    {
        // remember_tokenが一致するユーザを探す
        $user = DB::table('users')->where('email', $request->email)
            ->where('remember_token', $request->token)
            ->where('role', 0)->first();
        session()->flush();
        if (!$user) {
            return back()->with(['message' => '管理者もしくはトークンが無効です。']);
        } else {
            // パスワードを更新
            DB::table('users')->where('email', $request->email)->update(['password' => Hash::make($request->pass), 'remember_token' => null]);
            // パスワードリセット完了画面に遷移
            return view('auth.resetResult');
        }
    }
}
