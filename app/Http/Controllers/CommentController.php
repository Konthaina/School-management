<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */

    public function store(Request $request)
{
    $request->validate([
        'document_id' => 'required|exists:documents,id',
        'content' => 'required|string',
        'rating' => 'nullable|integer|min:1|max:5',
    ]);

    Comment::create([
        'document_id' => $request->document_id,
        'user_id' => auth()->id(),
        'content' => $request->content,
        'rating' => $request->rating,
    ]);

    return redirect()->route('documents.show', $request->document_id)
                     ->with('success', 'Comment posted successfully.');
}


    /**
     * Delete a comment (Admin or Owner).
     */
    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && !auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
