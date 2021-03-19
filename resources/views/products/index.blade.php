@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash')
            <h2>Produtos</h2>
            <div class="col-md-6">
                <a href="products/create" class="btn btn-primary">
                    New Product
                </a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action Origin</th>
                        <th>Stock Actions</th>
                        <th colspan="2">Product Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><a href="products/{{ $product->id }}/edit">{{ $product->sku }}</a></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->action_origin }}</td>
                            <td>
                                @if(isset($product->stock))
                                    <a href="{{route('stocks.edit', $product->stock->id)}}" class="btn btn-info">Edit Stock</a>
                                @else
                                    <a href="{{route('stocks.create')}}" class="btn btn-success">Create Stock</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-warning">Edit</a>
                                <form action="{{route('products.destroy', ['product' => $product->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="delete-item btn btn-danger" type="submit">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
