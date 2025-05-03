@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-4">
            <div class="form-group">
                <form action="{{ route('stock_list') }}" method="get" class="d-flex justify-content-end">
                    <input class="form-control mr-2 w-25" type="text" name="search" id="search" placeholder="検索">
                    <input class="btn btn-primary" type="submit" value="検索">
                </form>
            </div>
            @if (isset($search))
                <div class="text-center h1 mt-3">"{{ $search }}"の検索結果</div>
            @else
                <div class="text-center h1 mt-3">在庫一覧</div>
            @endif
            @if (count($stocks) != 0)
                    @foreach ($stocks as $stock)
                        <ul class="list-group">
                            <a href="{{ route('stock_detail', ['id' => $stock->id]) }}" class="text-decoration-none text-dark">
                                <li class="list-group-item d-flex align-items-center">
                                    @if ($stock->product->image)
                                        <img src="{{ asset('storage/' . $stock->product->image) }}" class="me-3 mr-4"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <h4 class="mb-1">商品名 : {{ $stock->product->name }}</h4>
                                        <div class="d-flex justify-content-start">
                                            <p class="mb-0 mr-4 h4">店舗名 : {{ $stock->store->name }}</p>
                                            <p class="mb-0 h4">在庫数 : {{ $stock->count }}個</p>
                                        </div>
                                    </div>
                                </li>
                            </a>
                            <button class="btn btn-primary mb-4 product_detail_open" value="{{ $stock->product->id }}"
                                data-url="{{ route('ajax.product_detail') }}">商品詳細</button>
                        </ul>
                    @endforeach
                    <div class="modal" tabindex="-1" id="modal01">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center">商品詳細</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                </div>
                                <div class="modal-body text-left" id="productModal">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="text-center mt-4">
                <div class="alert alert-warning h2">在庫はまだありません。</div>
            </div>
        @endif
    </main>
@endsection