@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center ml-0 mr-0 h-100">
                <div class="card w-100 text-center shadow">
                    <div class="card-header h3">商品情報登録完了</div>
                    <h4 class="text-center my-3">商品名 : {{ $product->name }}</h4>
                    <h4 class="text-center my-3">カテゴリー : {{ $category->name }}</h4>
                    @if ($product->image)
                        <div class="d-flex justify-content-center my-3">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-50" />
                        </div>
                    @endif
                    <div class="d-flex justify-content-center my-3">
                        <a class="btn btn-success btn-lg" href="{{ url('/') }}">ホームに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection