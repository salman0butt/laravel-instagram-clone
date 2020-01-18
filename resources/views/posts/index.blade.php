@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($posts->count() > 0)
        @foreach($posts as $post)
            <div class="row">
                <span class="col-4 offset-2 mt-2 p-2" style="background-color: white;">
             <div class="d-flex align-items-center">
                 <div class="pr-3">
                     <img src="{{ '/storage/'.$post->user->profile->image }}" class="rounded-circle w-100"
                          style="max-width: 40px;">
                 </div>
                 <div>
                     <div class="font-weight-bold">
                         <a href="{{ url('/profile/'.$post->user->id) }}">
                             <span class="text-dark">{{ $post->user->username }}</span></a>
{{--                         <a href="#" class="pl-3">Follow</a>--}}
                         <p class="mb-0" style="font-weight: 100">{{ $post->created_at->diffForHumans() }}</p>
                     </div>
                 </div>
             </div>
{{--              <hr>--}}
              <p class="pl-5 pt-2 mb-0"><span class="font-weight-bold"><a href="{{ url('/profile/'.$post->user->id) }}"></a></span> {{ $post->caption }}</p>
            </div>
            <div class="row">
                <div class="col-8 offset-2 pr-0 pl-0">
                    <a href="{{ url('/p/'.$post->id) }}"><img src="/storage/{{ $post->image }}" class="w-100 mt-2"></a>
                </div>
            </div>
    @endforeach
        <div class="row">
            <div class="col-md-8 offset-2 mt-4 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
        @else
        <h1 class="text-center text-muted mt-5">No Posts Availabe</h1>
        @endif
    </div>
@endsection
