@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-7 offset-1 pr-0 pl-0">
              <img src="/storage/{{ $post->image }}" class="w-100 mt-2">
          </div>
          <span class="col-4 mt-2 p-2" style="background-color: white;">
             <div class="d-flex align-items-center">
                 <div class="pr-3">
                     <img src="{{ '/storage/'.$post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;">
                 </div>
                 <div>
                     <div class="font-weight-bold">
                         <a href="{{ url('/profile/'.$post->user->id) }}">
                             <span class="text-dark">{{ $post->user->username }}</span></a>
                          <p class="mb-0" style="font-weight: 100">{{ $post->created_at->diffForHumans() }}</p>
{{--                         <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>--}}
                     </div>

                 </div>
             </div>
              <hr>
              <p class="pl-3"><span class="font-weight-bold"><a href="{{ url('/profile/'.$post->user->id) }}"><span class="text-dark">{{ $post->user->username }}</span></a></span> {{ $post->caption }}</p>
          </div>
      </div>
  </div>
@endsection
