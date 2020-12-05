@extends('layouts.main')

@section('content')
    <div class="container mt-2">
        <form
            action="/image-upload"
            method="POST"
            enctype="multipart/form-data"
            >

            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="image">Product</label>
                <select id="product_id" class="form-control" name="product_id">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="image">Product Image</label>
                <input class="form-control" id="image" type="file" name="image">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">
                    Upload Image
                </button>
            </div>
        </form>
    </div>
@endsection
