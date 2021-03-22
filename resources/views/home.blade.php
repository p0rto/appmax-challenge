@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Page</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><a class="btn btn-primary" href="/products">Products</a></th>
                        <td>Add, edit or remove products.</td>
                    </tr>
                    <tr>
                        <th scope="row"><a class="btn btn-primary" href="/stocks">Stocks</a></th>
                        <td>Add, edit or remove stocks.</td>
                    </tr>
                    <tr>
                        <th scope="row"><a class="btn btn-primary" href="/reports">Reports</a></th>
                        <td>Reports with the history of movements in the stock.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
