@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header h3">パスワードリセット</div>
                        <div class="card-body">
                            <form action="{{ route('pass_update') }}" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                                <div class="form-group row">
                                    <label for="pass">新しいパスワード</label>
                                    @error('password')
                                        <div class="alert alert-warning">{{ $message }}</div>
                                    @enderror
                                    <input type="password" id="pass" class="form-control" name="pass">
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