<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the comments.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'document'])->latest()->get();
        return view('super_admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new comment.
     */
    public function create()
    {
        $documents = Document::all(); // Get all documents
        return view('super_admin.comments.create', compact('documents'));
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_id' => 'required|exists:documents,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Comment::create($request->all());

        return redirect()->route('comments.index')->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment)
    {
        return view('super_admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment)
    {
        $documents = Document::all(); // Get all documents
        return view('super_admin.comments.edit', compact('comment', 'documents'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'document_id' => 'required|exists:documents,id',
            'content' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $comment->update($request->all());

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
