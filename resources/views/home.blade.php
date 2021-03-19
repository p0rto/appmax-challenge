@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a class="btn btn-light" href="/products">Products</a>
                            <a class="btn btn-dark" href="/stocks">Stock</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
