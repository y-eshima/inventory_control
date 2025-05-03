<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword;
use App\Mail\PasswordResetMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * パスワードリセットフォームを表示するメソッド
     */
    public function showResetForm()
    {
        return view('auth.resetForm');
    }

    /**
     * パスワードリセット用のトークンをメールで送信するメソッド
     */
    public function sendResetLink(ResetPassword $request)
    {
        // パスワードが存在するか確認
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            return view('auth.resetForm')->with(['message' => 'アカウントが存在しません。']);
        } else {
            if ($user->role == 1) {
                return view('auth.resetForm')->with(['message' => '管理者はパスワードをリセットできません。']);
            } else {
                // remember_tokenを生成
                $token = Str::random(64);
                // usersテーブルのremember_tokenを更新
                DB::table('users')->where('email', $request->email)->update(['remember_token' => $token]);
                // パスワードリセットメールを送信
                Mail::to($user->email)->send(new PasswordResetMail($user, $token));
                return view('auth.resetForm')->with(['message' => $user->email . 'へメールを送信しました。']);
            }
        }
    }
}
