@extends('layouts.app')
@section('content')
    <main>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card w-100 shadow">
                        <div class="card-header h3 text-center">パスワードリセット</div>
                        <div class="card-body">
                            <form action="{{ route('reset_send_mail') }}" method="post">
                                <div class="form-group my-3">
                                    <label>メールアドレス</label>
                                    @if($errors->has('email'))
                                        <div class="alert alert-warning" role="alert">{{ $errors->first('email') }}</div>
                                    @endif
                                    @if (isset($message))
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @endif
                                    @csrf
                                    <input type="text" class="form-control" name="email">
                                </div>
                                <div class="text-center">
                                    <input type="submit" value="メール送信" class="btn btn-primary btn-lg w-25">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-25 ml-5">戻る</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection