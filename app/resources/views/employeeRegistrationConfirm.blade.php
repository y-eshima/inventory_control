@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center ml-0 mr-0 h-100">
                <div class="card w-100 text-center shadow">
                    <div class="card-header h3">社員情報登録完了</div>
                    <h4 class="text-center my-3">社員名 : {{ $employee->name }}</h4>
                    <h4 class="text-center my-3">メールアドレス : {{ $employee->email }}</h4>
                    <h4 class="text-center my-3">パスワード : {{ str_repeat('●',strlen($pass)) }}</h4>
                    <h4 class="text-center my-3">所属店舗 : {{ $store->name }}</h4>
                    <div class="d-flex justify-content-center my-3">
                        <a class="btn btn-success btn-lg" href="{{ url('/') }}">ホームに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection