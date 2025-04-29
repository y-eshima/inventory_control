@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center ml-0 mr-0 h-100">
                <div class="card w-100 text-center shadow">
                    <div class="card-header h3">新規商品登録</div>
                    <div class="card-body">
                        <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group my-3">
                                <label for="name" class="h4">商品名</label>
                                <input type="text" name="product_name" class="form-control" id="name">
                            </div>
                            <div class="form-group my-3">
                                <label for="category" class="h4">カテゴリー</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">カテゴリーを選択してください</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group my-3">
                                <label for="image" class="h4">画像登録</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg my-3">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection