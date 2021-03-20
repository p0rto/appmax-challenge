@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="mb-2 btn btn-primary" href="/reports">Reports</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Product SKU</th>
                        <th>Product Name</th>
                        <th>Operation</th>
                        <th>Quantity</th>
                        <th>Action Origin</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($historic as $historic)
                        <tr>
                            <td><a href="/stocks/{{ $historic->stock->id }}/edit">{{ $historic->stock->product->sku }}</a>
                                @if($historic->stock->quantity < 100)
                                    <p class="text-danger">Low stock!</p>
                                @endif
                            </td>
                            <td>{{ $historic->stock->product->name }}</td>
                            <td>@if($historic->operation === \App\Historic::ADD_STOCK_QUANTITY_OPERATION)
                                    Products added to stock.
                                @else
                                    Products removed from stock.
                                @endif
                            </td>
                            <td>{{ $historic->quantity }}</td>
                            <td>@if($historic->action_origin === \App\Historic::SYSTEM_ORIGIN)
                                    System
                                @else
                                    API
                                @endif
                            </td>
                            <td>{{ $historic->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
