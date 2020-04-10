<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Post;
use App\Like;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::withCount('likes')->whereIn('user_id', auth()->user()->following()->where('accepted','=',1)
                                        ->pluck('to_user_id'))
                                        ->orderBy("created_at","DESC")
                                        ->paginate(3);
        $active_home = "primary";
        return view('home',compact('posts','active_home'));
    }

    public function userFriendPosts($id)
    {
        //$is_follower = Follower::where(['from_user_id'=>auth()->user()->id, 'to_user_id'=>$id, 'accepted'=>1])->get();
        //if(isset($is_follower[0])){
        if (policy(Post::Class)->show_friend(auth()->user(),$id)) {
            $posts=Post::withCount('likes')->where(["user_id"=>$id])->paginate(9);
            return view('post_views.friend_posts',compact('posts'));
        }
        else
            return redirect('not_found');
    }

    public function userPosts(Request $request)
    {
        $posts= Post::where(['user_id'=>auth()->user()->id])->orderBy('created_at', 'DESC')->paginate(3);
        return view('post_views.user_posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // loade the new post view
        return view('post_views.new_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save the data post
        if($request->hasFile('filename'))
        {
            $file  = $request->file('filename');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/post/', $name);
        }

        $post = new Post();
        $post->user_id  = auth()->user()->id;
        $post->body =   $request->get('body');
        $post->image_path = $name;
        $post->save();
        return redirect('/post/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::with('user')->find($id);
        $user = auth()->user();
        if(auth()->user()->can('show', $post)){
            $post_comments = Post::with('comments')->find($id);
            $count = Like::where('post_id', $id)->count();
            $userLike = Like::where(['user_id'=>auth()->user()->id, 'post_id'=>$id])->get();
            return view('post_views.view_post', compact('post', 'count', 'userLike', 'post_comments'));
        }
        else
            return redirect('not_found');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::find($id);
        //if ($post->user_id==auth()->user()->id)
        if (auth()->user()->can('edit', $post))
            return view('post_views.edit_post',compact('post'));
        else
            return redirect('not_found');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);
        //if ($post->user_id==auth()->user()->id)
        if (auth()->user()->can('update', $post))
        {
            $post->body=$request->get('body');
            $post->save();
            return redirect('post/'.$id);
        }
        else
            return redirect('not_found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        // if ($post->user_id==auth()->user()->id)
        if (auth()->user()->can('delete', $post))
        {
            $post->delete();
            return redirect('user/posts');
        }
        else
            return redirect('not_found');
    }
}
