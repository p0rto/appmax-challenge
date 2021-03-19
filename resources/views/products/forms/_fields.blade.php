@csrf
<div class="mb-3">
    <label for="inputSku" class="form-label">SKU</label>
    <input type="text" name="sku" @isset($product) value="{{$product->sku}}" @endisset class="form-control" id="inputSku" aria-describedby="skuHelp" required>
</div>
<div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" name="name" @isset($product) value="{{$product->name}}" @endisset class="form-control" id="inputName" required>
</div>
<div class="mb-3">
    <label for="inputPrice" class="form-label">Price</label>
    <input type="number" name="price" @isset($product) value="{{$product->price}}" @endisset class="form-control-sm" id="inputPrice" step="0.01" required>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
