@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/p') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Post</h1>
                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-12 col-form-label">Post Caption:</label>
                        <div class="col-md-12">
                            <input id="caption" type="text"
                                   class="form-control @error('caption') is-invalid @enderror" name="caption"
                                   value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-12 col-form-label">Post Image:</label>
                        <input type="file" class="col-md-12 form-control-file" id="image" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row pt-3">
                        <button class="btn btn-primary col-md-12">Add New Post</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
