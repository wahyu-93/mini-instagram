<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;

class NotifController extends Controller
{
    public function notifKomentar()
    {
        $user = auth()->user()->id;

        $notifs = Notification::where('user_id', $user)->paginate(10);
        return view('user.notif', compact('notifs'));
    }

    public function notifKomentarSeen()
    {
        $user = auth()->user()->id;
        $notifs = Notification::where('user_id', $user)->update(['seen' => true]);

        return ['msg' => 'sukses'];
    }

    public function notifCount()
    {
        $total = Auth::user()->notifications()->where('seen', 0)->count();
        return ['total' => $total];
    }
}
