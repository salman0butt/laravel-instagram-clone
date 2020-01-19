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
                     <img src="{{ $post->user->profile->getImage() }}" class="rounded-circle w-100"
                          style="max-width: 40px;">
                 </div>
                 <div>
                     <div class="font-weight-bold">
                         <a href="{{ url('/p/'.$post->user->id) }}">
                             <span class="text-dark">{{ $post->user->username }}</span></a>
                          <p class="mb-0" style="font-weight: 100">{{ $post->created_at->diffForHumans() }}</p>
                        @can('update', $post->user->profile)
                         <div class="row">
                                 <div class="col-md-3">
                             <a href="{{ url('/p/'.$post->id.'/edit') }}" class="btn btn-primary pt-0 pb-0">Edit</a>
                         </div>
                         <div class="col-md-8 offset-1">
                              <form action="{{ url('/p/'.$post->id) }}" method="post">
                             @csrf
                                  @method('delete')
                             <button type="submit" class="btn btn-danger pt-0 pb-0">Delete</button>
                         </form>
                           </div>
                         </div>
                         @endcan
{{--                         <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>--}}
                     </div>

                 </div>
             </div>
              <hr>
              <p class="pl-3"><span class="font-weight-bold"><a href="{{ url('/profile/'.$post->user->id) }}"><span
                              class="text-dark">{{ $post->user->username }}</span></a></span> {{ $post->caption }}</p>
        </div>
    </div>
    </div>
@endsection
