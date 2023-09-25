<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Setting;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Menampilkan halaman notif
    public function index()
    {
        $setting = Setting::first();
        $story = Story::where('user_id', Auth::guard('pengguna')->user()->id)->get();
        $story_id = array();
        foreach ($story as $row) {
            if (isset($story_id[$row->id])) {
                $story_id[$row->id] .= $row->id;
            } else {
                $story_id[$row->id] = $row->id;
            }
        }
        $like = Like::whereIn('story_id', $story_id)
            ->where('user_id', '<>', Auth::guard('pengguna')->user()->id)
            ->whereDate('created_at', date('Y-m-d'));
        $comment = Comment::whereIn('story_id', $story_id)
            ->where('user_id', '<>', Auth::guard('pengguna')->user()->id)
            ->whereDate('created_at', date('Y-m-d'));

        return view('notif.index', compact('setting', 'like', 'comment'));
    }
}
