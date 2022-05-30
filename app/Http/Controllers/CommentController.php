<?php

namespace App\Http\Controllers;

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
            'user_id'   => $user->id,
            'body'      => $request->input('body')
        ]);


        return redirect()->back();

    }
}
