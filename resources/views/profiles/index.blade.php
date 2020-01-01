@extends('layouts.app')

@section('content')
    <div class="container" style="width: 60%;margin: 0 auto;">
        <div class="row">
            <div class="col-3 p-5">
                <img
                    src="https://instagram.fisb6-1.fna.fbcdn.net/v/t51.2885-19/s150x150/70985486_577637296311063_2240788552625422336_n.jpg?_nc_ht=instagram.fisb6-1.fna.fbcdn.net&_nc_ohc=xrPveZewv2IAX_R-cHz&oh=c3605cff4054a4bf3cb631926f4df55e&oe=5EAA2DD7"
                    alt="profile" class="rounded-circle">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h1>{{ $user->username }}</h1>
                    <a href="{{ url('p/create') }}" class="btn btn-primary">Add New Post</a>
                </div>
                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-5"><strong>23k</strong> followers</div>
                    <div class="pr-5"><strong>212</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url }}</a></div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <img src="{{ '/storage/'.$post->image }}" class="w-100">
                </div>
            @endforeach
        </div>
    </div>
@endsection
//TODO Starts From 2:20
