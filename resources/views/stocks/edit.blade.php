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
            <form method="POST" action="{{route('stocks.update', ['stock' => $stock->id])}}">
                @method('PUT')
                @include('stocks.forms._fields')
            </form>
        </div>
    </div>
@endsection
