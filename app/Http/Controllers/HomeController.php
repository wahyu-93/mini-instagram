<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $list_id = $user->following()->pluck('follows.following_id')->toArray();
        $list_id[] = $user->id;

        $posts = Post::with('user', 'likes')->wherein('user_id', $list_id)->orderBy('created_at', 'desc')->get();
            
        return view('home', compact('user', 'posts'));
    }

    public function search(Request $request)
    {
        $querySearch = $request->input('query');

        $posts = Post::with('user', 'likes')->where('caption', 'like' , '%'. $querySearch .'%')->orderBy('created_at', 'desc')->get();

        return view('home', compact('posts', 'querySearch'));

    }
}
