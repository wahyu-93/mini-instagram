<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        return redirect()->back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        
        return view('post.comment-edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'body'  => $request->input('body')
        ]);

        return redirect()->route('post.show', [$comment->post->id]);
    }
}
