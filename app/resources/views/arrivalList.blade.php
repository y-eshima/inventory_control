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
                        <a href="{{ route('stock_detail', ['id' => $stock->id]) }}" class="text-decoration-none text-dark">
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center mb-3">
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
                            </ul>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center mt-4">
                    <div class="alert alert-warning h2">在庫はまだありません。</div>
                </div>
            @endif
    </main>
@endsection