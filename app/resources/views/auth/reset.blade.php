@extends('layouts.app')
@section('content')
    <main>
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header h3">パスワードリセット</div>
                        <div class="card-body">
                            <form action="{{ route('pass_update') }}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                                <div class="form-group my-3">
                                    <label for="pass">新しいパスワード</label>
                                    @if ($errors->has('pass'))
                                        <div class="alert alert-warning" role="alert">{{ $errors->first('pass') }}</div>
                                    @endif
                                    <input type="password" id="pass" class="form-control" name="pass" minlength="6" maxlength="16" required="required">
                                    <label for="pass_conf">再確認</label>
                                    @if ($errors->has('pass_conf'))
                                        <div class="alert alert-warning" role="alert">{{ $errors->first('pass_conf') }}</div>
                                    @endif
                                    <input type="password" id="pass_conf" class="form-control" name="pass_conf" minlength="6" maxlength="16" required="required">
                                </div>
                                <input type="submit" value="パスワードを更新" class="btn btn-primary btn-lg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection