@extends('layouts.layout')
@section('content')
<main>
    <div class="container mt-5">
        <div class="row g-4">
            <div class="col-6">
                <a href="{{ route('stock_list') }}" class="btn btn-primary w-100 py-5 my-4 fs-4 h4">在庫確認</a>
            </div>
            <div class="col-6">
                <a href="#" class="btn btn-primary w-100 py-5 my-4 fs-4 h4">入荷確認</a>
            </div>
        </div>
        @if ($user->role == 1)
        <div class="row g-4">
            <div class="col-6">
                <a href="{{ route('user_create') }}" class="btn btn-primary w-100 py-5 my-4 fs-4 h4">社員登録</a>
            </div>
            <div class="col-6">
                <a href="{{ route('product_form') }}" class="btn btn-primary w-100 py-5 my-4 fs-4 h4">商品登録</a>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection