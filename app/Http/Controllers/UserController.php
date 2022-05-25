<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'  => ['required', 'max:15', 'min:3', 'alpha_dash', 'unique:users,username,'.$user->id],
            'fullname'  => ['max:30'],
            'bio'       => ['max:144'],
            'avatar'    => 'image|mimes:jpg,jpeg,png',
        ]);

        $imageName = $request->avatar;
        if ($request->avatar){
            $avatarImage = $request->avatar;
            $imageName = $user->username . time() . '.' . $avatarImage->extension();
            $avatarImage->move(public_path('images/avatar'), $imageName);
        };

        $user->update([
            'username'  => $request->username,
            'fullname'  => $request->fullname,
            'bio'       => $request->bio,
            'avatar'    => $imageName,
        ]);

        return redirect()->route('home');
    }

    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if(!$user) abort(403);

        return view('user.profile', compact('user'));
    }
}
