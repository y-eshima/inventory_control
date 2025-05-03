@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card w-100 shadow">
                        <div class="card-header h3 text-center">入荷確定</div>
                        <div class="card-body d-flex align-items-center">
                            @if ($stock->product->image)
                                <img src="{{ asset('storage/' . $stock->product->image) }}" class="w-80 mr-5">
                            @endif
                            <div class="d-flex flex-column text-start ml-5">
                                <p class="h2">商品名 : {{ $stock->product->name }}</p>
                                <p class="h2 pt-3">在庫数 : {{ $stock->count }}</p>
                                <p class="h2 pt-3">在庫重量 : {{ $stock->weight }}</p>
                                <p class="h2 pt-3">在庫管理店舗 : {{ $stock->store->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('arrival_list') }}" class="btn btn-primary btn-lg mt-5 w-100">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection