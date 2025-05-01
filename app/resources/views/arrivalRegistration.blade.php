@extends('layouts.layout')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center ml-0 mr-0 h-100">
                <div class="card w-100 text-center shadow">
                    <div class="card-header h3">入荷情報登録</div>
                    <div class="card-body">
                        <form action="{{ route('arrival_store') }}" method="post">
                            @csrf
                            <div class="form-group my-3">
                                <label for="product" class="h4">商品</label>
                                @if ($errors->has('product_id'))
                                    <div class="alert alert-warning" role="alert">{{ $errors->first('product_id') }}</div>
                                @endif
                                <select name="product_id" class="form-control" id="product">
                                    <option value="">商品を選択してください</option>
                                    @foreach ($products as $product)
                                        @if ($product['id'] == old('product_id'))
                                            <option value="{{ $product['id'] }}" selected>{{ $product['name'] }}</option>
                                        @else
                                            <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group my-3">
                                <label for="date" class="h4">入荷予定日</label>
                                @if ($errors->has('date'))
                                    <div class="alert alert-warning" role="alert">{{ $errors->first('date') }}</div>
                                @endif
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="form-group my-3">
                                <label for="count" class="h4">入荷個数</label>
                                @if ($errors->has('count'))
                                    <div class="alert alert-warning" role="alert">{{ $errors->first('count') }}</div>
                                @endif
                                <input type="number" class="form-control" id="count" name="count">
                            </div>
                            <div class="form-group my-3">
                                <label for="weight" class="h4">入荷重量</label>
                                @if ($errors->has('weight'))
                                    <div class="alert alert-warning" role="alert">{{ $errors->first('weight') }}</div>
                                @endif
                                <input type="number" class="form-control" id="weight" name="weight">
                            </div>
                            <input type="submit" class="btn btn-primary w-100" value="登録">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection