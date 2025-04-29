@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center ml-0 mr-0 h-100">
                <div class="card w-100 text-center shadow">
                    <div class="card-header h3">社員情報登録</div>
                    <div class="card-body">
                        <form action="{{ route('user_store') }}" method="post">
                            @csrf
                            <div class="form-group my-3">
                                <label for="name" class="h4">社員名</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group my-3">
                                <label for="email" class="h4">メールアドレス</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group my-3">
                                <label for="pass" class="h4">パスワード</label>
                                <input type="password" name="pass" class="form-control" id="pass">
                            </div>
                            <div class="form-group my-3">
                                <label for="store" class="h4">所属店舗</label>
                                <select name="store_id" class="form-control" id="store">
                                    <option value="">店舗を選択してください</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store['id'] }}">{{ $store['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg my-3">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection