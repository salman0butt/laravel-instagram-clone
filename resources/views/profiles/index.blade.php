@extends('layouts.app')

@section('content')
    <div class="container" style="width: 60%;margin: 0 auto;">
        <div class="row">
            <div class="col-3 p-5">

                <img
                    src="{{ $user->profile->getImage() }}"
                    alt="profile" class="rounded-circle w-100">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                   <div class="d-flex align-items-center pb-3">
                       <h1>{{ $user->username }}</h1>
                       <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                   </div>
                    @can('update', $user->profile)
                        <a href="{{ url('p/create') }}" class="btn btn-danger">Add New Post</a>
                    @endcan

                </div>
                @can('update', $user->profile)
                    <a href="{{ url('/profile/'.$user->id.'/edit') }}">Edit Profile</a>
                 @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $followerCount }}</strong> followers</div>
                    <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
            </div>
        </div>

        <div class="row pt-5" style="border-top: 1px solid #ddd;">
            @if ($user->posts->count() > 0)
              @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="{{ url('/p/'.$post->id) }}">
                        <img src="{{ '/storage/'.$post->image }}" class="w-100">
                    </a>
                </div>
              @endforeach
            @else
           <div style="display: block;margin: 0 auto;">
               <h1 class="text-muted">No Users Posts</h1>
           </div>
            @endif

        </div>
    </div>
@endsection

