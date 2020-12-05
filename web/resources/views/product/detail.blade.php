@extends('layouts.main')

@section('content')
    <div class="container">
        <img class="img-responsive" src="{{ $product->image->url }}" alt="{{ $product->name }}">
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
    </div>
@endsection
