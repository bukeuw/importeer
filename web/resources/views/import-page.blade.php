@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-4 offset-4">
            <div class="card mt-5">
                <div class="card-body">
                    <form
                        action="/import"
                        method="POST"
                        enctype="multipart/form-data"
                        >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label" for="xls">Upload File</label>
                            <input class="form-control" id="xls" type="file" name="xls">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Upload File</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
