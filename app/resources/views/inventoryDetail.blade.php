@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card w-100 shadow">
                        <div class="card-header h3 text-center">在庫詳細</div>
                        <div class="card-body d-flex align-items-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-80 mr-5">
                            @endif
                            <div class="d-flex flex-column text-start ml-5">
                                <p class="h2">商品名 : {{ $product->name }}</p>
                                <p class="h2 pt-3">在庫数 : {{ $stock->count }}</p>
                                <p class="h2 pt-3">在庫重量 : {{ $stock->weight }}</p>
                                <p class="h2 pt-3">在庫管理店舗 : {{ $store->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('stock_form') }}" method="post" class="mt-5 w-50 mr-5">
                            @csrf
                            <input type="hidden" name="id" value="{{ $stock->id }}">
                            <button type="submit" class="btn btn-primary btn-lg w-100">在庫削除</button>
                        </form>
                        <a href="{{ route('stock_list') }}" class="btn btn-primary btn-lg mt-5 w-50">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection