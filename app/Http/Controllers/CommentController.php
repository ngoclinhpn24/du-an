<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    //Quản lý bình luận
    public function manageComment(){
        $comments = Comment::with('product')->orderBy('id')->get();
      
        return view('admin.manage_comment', ['comments' => $comments]);
    }

    //Xóa bình luân
    public function deleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back();
    }
}
