@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" action="{{route('products.update', ['product' => $product->id])}}">
                    @method('PUT')
                    @include('products.forms._fields')
                </form>
        </div>
    </div>
@endsection
