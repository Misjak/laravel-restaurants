<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Comment;
use App\CommentReply;


use Illuminate\Http\Request;

class CommentReplyController extends Controller
{
    public function store(Request $request, $comment_id) 
    {
        $this->validate($request, [
            'comment' => 'required'
        ]); 
    
        $reply= Restaurant::findOrFail($comment_id);
        $reply = new CommentReply;
    
        $reply ->comment_id = $comment_id;
        $reply ->comment = $request->input('comment');
    
        $reply ->save();
        
        return redirect()->back();
    }
}
