<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike($type, $object_id)
    {
        if($type=='post'){
            $object     = Post::findOrFail($object_id);
            $pesan      = "Post Anda Dilike Oleh ";
            $post       = $object;
            $type       = 'like-post';
        }
        else {
            $object     = Comment::findOrFail($object_id);
            $pesan      = "Komentar Anda Dilike Oleh ";
            $post       = $object;
            $type       = 'like-comment';
        };

        $attr = ['user_id' => Auth::user()->id];

        if ($object->likes()->where($attr)->exists()){
            $object->likes()->delete($attr);
            $message = ['message' => 'Unlike'];

            // $this->cancelLike(Auth::user(), $post, $type);
        }
        else {
            $object->likes()->create($attr);
            $message = ['message' => 'like'];

            $this->notify(Auth::user(), $post, $pesan, $type);
        };

        return response()->json($message);
    }

    private function notify($user, $post, $pesan, $type)
    {
        if($type=="like-post"){
            $target_user = $post->user_id;
            $post_id = $post->id;
        }
        else{
            $target_user = $post->user_id;
            $post_id = $post->post_id;
        };
                        
        // jika user mengomen/melike postnya/komennya sendiri tidak usah dimasukkan kedalam notif
        if($user->id != $target_user){
            Notification::create([
                'post_id'   => $post_id,
                'user_id'   => $target_user,
                'type'      => $type,
                'message'   => $pesan . $user->username
            ]);
        };
    }

    private function cancelLike($user, $post, $type)
    {
        $target_user = $post->user_id;
        
        if($user->id != $target_user){
            Notification::where('user_id', $target_user)->where('post_id', $post->id)->where('type', $type)->delete();
        };
    }
}
