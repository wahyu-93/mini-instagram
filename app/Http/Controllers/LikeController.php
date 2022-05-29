<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike($post_id)
    {
        $post = Post::findOrFail($post_id);
        $attr = ['user_id' => Auth::user()->id];

        if ($post->likes()->where($attr)->exists()){
            $post->likes()->delete($attr);
            $message = ['message' => 'Unlike'];
        }
        else {
            $post->likes()->create($attr);
            $message = ['message' => 'like'];
        };

        return response()->json($message);
    }
}
