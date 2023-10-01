<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $list = Comment::get();
        return view('panel.admin.comments.list', compact('list'));
    }

    public function update(Request $request, Comment $comment)
    {
        (new CommentService())->update($comment, $request->only('status'));

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully created.',
        ]);


    }
    public function destroy(Comment $comment)
    {
        (new CommentService())->delete($comment);

        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully deleted.',
        ]);

    }
}
