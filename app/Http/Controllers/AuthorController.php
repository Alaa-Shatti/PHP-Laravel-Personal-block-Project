<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:author');
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();

        $allComments = Comment::whereIn('post_id', $posts)->get();

        $commentsToday = $allComments->where('created_at', '>=', Carbon::today());

        return view('author.dashboard', compact('allComments', 'commentsToday'));
    }

    public function post()
    {
        return view('author.post');
    }

    public function comments()
    {
        return view('author.comments');
    }

    public function newPost()
    {
        return view('author.newPost');
    }

    public function createPost(CreatePost $request)
    {

        $post = new Post();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->user_id = Auth::id();
        $post->save();

        return back()->with('success', 'post is successfully created.');

    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

        return view('author.postEdit', compact('post'));
    }

    public function postEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Post updated successfully');

    }

    public function deletePost ($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->delete();

        return back();
    }

}
