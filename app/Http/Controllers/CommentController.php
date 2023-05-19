<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {
        Comment::create($request->all());
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if(Auth::check())
        {
       $comment = Comment::where('id',$request->comment_id)
       ->where('user_id',Auth::user()->id)
       ->first();
       $comment->delete();
       return response()->json([
        'status' => 200
       ]);
     }
    }

    public function adminDestroy(Request $request)
    {
        if(Auth::guard('admin')->check())
        {
       $comment = Comment::where('id',$request->comment_id);
       $comment->delete();
       return response()->json([
        'status' => 200
       ]);
     }
    }
}
