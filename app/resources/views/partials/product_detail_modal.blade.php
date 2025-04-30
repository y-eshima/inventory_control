<div class="modal fade" id="modal01" tabindex="-1" aria-labelledby="modal01Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">商品詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>商品名 : {{ $product->name }}</h5>
                <p>カテゴリー : {{ $category->name }}</p>
                <img src="{{ asset('storage/' . $product->image) }}">
            </div>
        </div>
    </div>
</div>