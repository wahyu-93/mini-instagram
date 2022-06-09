<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // validasi komentar - tidak boleh kosong
        $this->validate($request,[
            'body'  => 'required'
        ]);     

        $user = Auth::user();
        
        $user->comments()->create([
            'post_id'   => $post_id,
            'body'      => $request->input('body')
        ]);

        $this->notify($user, $post_id);

        return redirect()->back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        
        return view('post.comment-edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        
        if(Auth::user()->id != $comment->user_id){
            abort(403);
        };
     
        $comment->update([
            'body'  => $request->input('body')
        ]);



        return redirect()->route('post.show', [$comment->post->id]);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        
        $comment->delete();

        return redirect()->route('post.show', [$comment->post_id]);

    }

    private function notify($user, $post_id)
    {
        $target_user = Post::findOrFail($post_id)->user_id;
        
        // jika user mengomen postnya sendiri tidak usah dimasukkan kedalam notif
        if($user->id != $target_user){
            Notification::create([
                'post_id'   => $post_id,
                'user_id'   => $target_user,
                'message'   => "Post Anda Dikomentari Oleh ". $user->username
            ]);
        }
    }
}
