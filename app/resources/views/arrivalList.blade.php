@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-4">
            <div class="form-group">
                <form action="{{ route('arrival_list') }}" method="get" class="d-flex justify-content-end">
                    <input class="form-control mr-2 w-25" type="date" name="date">
                    <input class="form-control mr-2 w-25" type="text" name="search" placeholder="検索">
                    <input class="btn btn-primary" type="submit" value="検索">
                </form>
            </div>
            <div class="text-center h1 mt-3">入荷一覧</div>
            <a href="{{ route('arrival_register') }}" class="btn btn-primary btn-lg mb-4 w-100">入荷登録</a>
            @if (count($arrivals) != 0)
                    @foreach ($arrivals as $arrival)
                        <a href="{{ route('arrival_detail', ['id' => $arrival->id]) }}" class="text-decoration-none text-dark">
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center mb-3">
                                    @if ($arrival->product->image)
                                        <img src="{{ asset('storage/' . $arrival->product->image) }}" class="me-3 mr-4"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-start">
                                            <h4 class="mb-1 mr-5">商品名 : {{ $arrival->product->name }}</h4>
                                            <p class="mb-0 h4">店舗名 : {{ $arrival->store->name }}</p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <p class="mb-0 h4 mr-5">入荷数 : {{ $arrival->count }}個</p>
                                            <p class="mb-0 h4">入荷予定日 : {{ $arrival->formatted_date }}</p>
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