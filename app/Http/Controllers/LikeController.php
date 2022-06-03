<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike($type, $object_id)
    {
        if($type=='post'){
            $object = Post::findOrFail($object_id);
        }
        else {
            $object = Comment::findOrFail($object_id);
        };

        $attr = ['user_id' => Auth::user()->id];

        if ($object->likes()->where($attr)->exists()){
           $object->likes()->delete($attr);
            $message = ['message' => 'Unlike'];
        }
        else {
           $object->likes()->create($attr);
            $message = ['message' => 'like'];
        };

        return response()->json($message);
    }
}
