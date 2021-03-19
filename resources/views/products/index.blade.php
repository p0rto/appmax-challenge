@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Produtos</h2>
            <div class="col-md-6">
                <a href="products/create" class="btn btn-primary">
                    Novo Produto
                </a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th colspan="2">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><a href="products/{{ $product->id }}">{{ $product->sku }}</a></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{url('products/downAmount', $product->id)}}" class="btn btn-info">Dar baixa estoque</a>
                                <a href="{{url('products/upAmount', $product->id)}}" class="btn btn-success">Adicionar estoque</a>
                                <a href="{{action('ProductController@edit', $product->id)}}" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('products.destroy', ['product' => $product->id])}}" method="post">
                                    {{csrf_field()}} {{ method_field('delete') }}
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
