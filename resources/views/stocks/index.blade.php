@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.flash')
            <h2>Stocks</h2>
            <div class="col-md-6">
                <a href="stocks/create" class="btn btn-primary">
                    New Stock
                </a>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product SKU</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action Origin</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td><a href="stocks/{{ $stock->id }}/edit">{{ $stock->id }}</a></td>
                            <td>{{ $stock->product->sku }}</td>
                            <td>{{ $stock->product->name }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->action_origin }}</td>
                            <td>
                                <a href="{{route('stocks.edit', ['stock' => $stock->id])}}" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('stocks.destroy', ['stock' => $stock->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="delete-item btn btn-danger" type="submit">Delete</button>
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
