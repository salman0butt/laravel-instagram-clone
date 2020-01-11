@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-7 offset-1 pr-0 pl-0">
              <img src="/storage/{{ $post->image }}" class="w-100 mt-2">
          </div>
          <div class="col-4 mt-2 p-2" style="background-color: whitesmoke;">
              <h4>{{ $post->user->username }}</h4>
              <p>{{ $post->caption }}</p>
          </div>
      </div>
  </div>
@endsection
