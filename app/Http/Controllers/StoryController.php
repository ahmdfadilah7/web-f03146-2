<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Setting;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    // Menampilkan halaman story
    public function index()
    {
        $setting = Setting::first();
        $story = Story::orderBy('id', 'desc')->get();

        return view('story.index', compact('story', 'setting'));
    }

    // Menampilkan halaman my story
    public function my_story()
    {
        $setting = Setting::first();
        $story = Story::where('user_id', Auth::guard('pengguna')->user()->id)->orderBy('id', 'desc')->get();

        return view('story.mystory', compact('story', 'setting'));
    }

    // Menampilkan halaman tambah story
    public function create()
    {
        $setting = Setting::first();

        return view('story.add', compact('setting'));
    }

    // Proses tambah story
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Story::create([
            'user_id' => Auth::guard('pengguna')->user()->id,
            'story' => $request->get('story'),
        ]);

        return redirect()->route('story')->with('success', 'Create new story success.');
    }

    // Proses tambah like
    public function like($id)
    {
        $like = new Like;
        $like->user_id = Auth::guard('pengguna')->user()->id;
        $like->story_id = $id;
        $like->save();

        return back()->with('success', 'Liked story.');
    }

    // Proses tambah comment
    public function comment(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::guard('pengguna')->user()->id;
        $comment->story_id = $request->get('story_id');
        $comment->comment = $request->get('comment');

        if ($comment->save()) {
            return response()->json(data: 'success', status: '201');
        } else {
            return response()->json(data: 'fail', status: '400');
        }
    }

    // Proses delete comment
    public function delete_comment(Request $request)
    {
        $comment_id = $request->get('comment_id');
        $comment = Comment::find($comment_id);

        if ($comment->delete()) {
            return response()->json(data: 'success', status: '201');
        } else {
            return response()->json(data: 'fail', status: '400');
        }
    }
}
