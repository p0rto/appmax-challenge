@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Link</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><a class="btn btn-success" href="/reports/added-products">Added Products</a></th>
                        <td>Report showing the history of product additions in stock.</td>
                    </tr>
                    <tr>
                        <th scope="row"><a class="btn btn-danger" href="/reports/removed-products">Removed Products</a></th>
                        <td>Report showing the history of product removals from stock.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
