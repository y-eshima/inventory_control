<div class="modal-body">
    <h5>商品名 : {{ $product->name }}</h5>
    <p>カテゴリー : {{ $category->name }}</p>
    <img src="{{ asset('storage/' . $product->image) }}">
</div>