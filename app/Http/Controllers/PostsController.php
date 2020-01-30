<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    //
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();


        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post, User $user)
    {
        $post_id = $post->id;
//        $like_check = Like::where('post_id','=',$post_id)->where('like','=',1)->count();
//        $dislike_check = Like::where('post_id','=',$post_id)->where('like','=',0)->count();
//            dump($like_check);
//            dd($dislike_check);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false;
        return view('posts.show', compact('post', 'follows','dislike_check','like_check'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update($post)
    {
        $photo = Post::findOrFail($post);
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        if (request('image')) {
            // unlink(public_path() .'/storage/'.$photo->image);
            $imagePath = request('image')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();
        }
        Post::where('id', $post)->update([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect()->back();
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . '/storage/' . $post->image);
        $post->delete();
        return redirect('/profile/' . auth()->user()->id);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request->postId;
        $user_id = $request->userId;
        $is_like = $request->isLike;
        $like_check = Like::where('user_id','=',$user_id)->where('post_id','=',$post_id)->where('like','=',1)->count();
        $dislike_check = Like::where('user_id','=',$user_id)->where('post_id','=',$post_id)->where('like','=',0)->count();

        if ($like_check > 0){
       Like::where('user_id','=',$user_id)->where('post_id','=',$post_id)->update(['like'=> '0']);
       return "Disliked";
       }else if($dislike_check > 0){
            Like::where('user_id','=',$user_id)->where('post_id','=',$post_id)->update(['like'=> '1']);
            return "Liked";
        }
        $data = [
          'post_id'=>$post_id,
          'user_id' => $user_id,
            'like' => 1
        ];
        $like = Like::create($data);
       // return response()->json(['like_count' => $like_check, 'dislike_count' => $like_check]);


    }


}
