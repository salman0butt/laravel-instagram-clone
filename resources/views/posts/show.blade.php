@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-1 pr-0 pl-0">
                <img src="/storage/{{ $post->image }}" class="w-100 mt-2">
                <div class="interaction mt-2">
{{--                    <span class="badge badge-light">{{ $like_check }}</span>--}}
                    <a href="#"
                       class="btn btn-xs btn-warning like" id="Like" onclick="like(this.id)">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |

{{--                    <span class="badge badge-light"> {{ $dislike_check }}</span>--}}
                    <a href="#"
                       class="btn btn-xs btn-danger like" id="Dislike" onclick="like(this.id)">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                </div>
            </div>

            <span class="col-4 mt-2 p-2" style="background-color: white;">
             <div class="d-flex align-items-center">
                 <div class="pr-3">
                     <img src="{{ $post->user->profile->getImage() }}" class="rounded-circle w-100"
                          style="max-width: 40px;">
                 </div>

                 <div>
                     <div class="font-weight-bold">
                         <a href="{{ url('/profile/'.$post->user->id) }}">
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
                         <br>

{{--                         <follow-button user-id="{{ $post->user->id }}" follows="{{ $follows }}"></follow-button>--}}
                     </div>

                 </div>
             </div>

              <hr>
              <p class="pl-3"><span class="font-weight-bold"><a href="{{ url('/profile/'.$post->user->id) }}">{{ $post->user->username }}</a></span><span class="text-dark"> {{ $post->caption }}</span></p>
       <div>
    </div>
@section('scripts')
{{--    <script src="{{ asset('/js/like.js') }}"></script>--}}
    <script>

// let postId = 0;
function like(clicked_id) {

    postId = '{{ $post->id }}';
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {postId: postId, _token: token,isLike: clicked_id , userId: '{{ auth()->user()->id }}'}
    })
        .done(function (response) {
            console.log(response);
               // $('#Like').html('test');
        });
}
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';
</script>
@endsection
@endsection
