<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function notifKomentar()
    {
        $user = auth()->user()->id;

        $notifs = Notification::where('user_id', $user)->get(); 
        return view('user.notif', compact('notifs'));
    }
}
