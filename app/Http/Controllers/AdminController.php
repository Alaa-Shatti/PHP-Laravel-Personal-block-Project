<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:admin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function post()
    {
        return view('admin.post');
    }

    public function comments()
    {
        return view('admin.comments');
    }

    public function users()
    {
        return view('admin.users');
    }
    public function info()
    {
        $comments = Comment::all();
        $posts = Post::all();
        return view('admin.info', compact('posts', 'comments'));
    }

}
