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
            <div class="text-center h1 mt-3">入荷一覧</div>
            @if (count($arrivals) != 0)
                    @foreach ($arrivals as $arrival)
                        <a href="{{ route('stock_detail', ['id' => $arrival->id]) }}" class="text-decoration-none text-dark">
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center mb-3">
                                    @if ($arrival->product->image)
                                        <img src="{{ asset('storage/' . $arrival->product->image) }}" class="me-3 mr-4"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <h4 class="mb-1">商品名 : {{ $arrival->product->name }}</h4>
                                        <div class="d-flex justify-content-start">
                                            <p class="mb-0 mr-4 h4">店舗名 : {{ $arrival->store->name }}</p>
                                            <p class="mb-0 h4">在庫数 : {{ $arrival->count }}個</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </a>
                    @endforeach
                </div>
            @else
            <div class="text-center mt-4">
                <div class="alert alert-warning h2">入荷はまだありません。</div>
            </div>
        @endif
    </main>
@endsection