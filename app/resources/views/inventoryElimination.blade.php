@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card w-100 shadow">
                        <div class="card-header h3 text-center">在庫詳細</div>
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
                    <form action="{{ route('stock_delete') }}" method="post" class="mt-5">
                        @csrf
                        <input type="hidden" value="{{ $stock->id }}" name="id">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex w-50 mr-3 align-items-center">
                                <label for="count" class="mr-2 h5 flex-shrink-0 mb-0">減少個数</label>
                                <input id="count" type="number" name="count" class="form-control">
                            </div>
                            <div class="d-flex w-50 align-items-center">
                                <label for="weight" class="mr-2 h5 flex-shrink-0 mb-0">減少重量</label>
                                <input id="weight" type="number" name="weight" class="form-control">
                            </div>
                        </div>
                        <div class="align-items-center">
                            <input type="submit" value="在庫削除" class="btn btn-primary mt-4 btn-lg w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection