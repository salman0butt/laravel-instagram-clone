@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/profile/'.$user->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Profile</h1>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-12 col-form-label">Title:</label>
                        <div class="col-md-12">
                            <input id="title" type="text"
                                   class="form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') ?? $user->profile->title}}" required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-12 col-form-label">Description:</label>
                        <div class="col-md-12">
                            <input id="description" type="text"
                                   class="form-control @error('description') is-invalid @enderror" name="description"
                                   value="{{ old('description') ?? $user->profile->description }}" required autocomplete="description" autofocus>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-md-12 col-form-label">url:</label>
                        <div class="col-md-12">
                            <input id="url" type="text"
                                   class="form-control @error('url') is-invalid @enderror" name="url"
                                   value="{{ old('url') ?? $user->profile->url }}" required autocomplete="url" autofocus>

                            @error('url')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-12 col-form-label">Profile Image:</label>
                        <input type="file" class="col-md-12 form-control-file" id="image" name="image">
                        @error('image')
                        <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row pt-3">
                        <button class="btn btn-primary col-md-12">Save Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
