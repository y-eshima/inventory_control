<div class="modal-body justify-content-center text-center">
    <h2>商品名 : {{ $product->name }}</h2>
    <h3>カテゴリー : {{ $category->name }}</h3>
    <img class="w-100" src="{{ asset('storage/' . $product->image) }}">
</div>