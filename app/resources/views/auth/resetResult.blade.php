@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header h3">パスワードリセット</div>
                        <div class="card-body">
                            <h4>パスワードリセット完了しました。</h4>
                            <p>以下のボタンからログインしてください。</p>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">ログイン</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection