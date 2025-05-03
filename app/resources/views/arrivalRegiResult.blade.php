@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card w-100 shadow">
                        <div class="card-header h3 text-center">入荷登録完了</div>
                        <div class="card-body d-flex align-items-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="mr-5 w-50">
                            @endif
                            <div class="d-flex flex-column text-start ml-5">
                                <p class="h2">商品名 : {{ $product->name }}</p>
                                <p class="h2 pt-3">入荷個数 : {{ $arrival->count }}</p>
                                <p class="h2 pt-3">入荷重量 : {{ $arrival->weight }}</p>
                                <p class="h2 pt-3">入荷予定日 : {{ $arrival->formatted_date }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('arrival_list') }}" class="btn btn-primary btn-lg w-100 mt-4">入荷一覧へ戻る</a>
                </div>
            </div>
        </div>
    </main>
@endsection