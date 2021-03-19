@csrf
<div class="mb-3">
    <select name="product_id" class="form-select">
        @if(isset($stock))
            <option value="{{ $stock->product->id }}" selected>
                {{ $stock->product->sku }} - {{ $stock->product->name }}
            </option>
        @endif
        @foreach($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->sku }} - {{ $product->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="inputQuantity" class="form-label">Quantity</label>
    <input type="number" name="quantity" @isset($stock) value="{{$stock->quantity}}" @endisset
        class="form-control" id="inputQuantity" aria-describedby="quantityHelp"
        min="0" step="1" required>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
