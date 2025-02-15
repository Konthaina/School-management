<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::all();
        return view('super_admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('super_admin.documents.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4',
            'keywords' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,zip,doc,docx,txt|max:10240',
            'user_id' => 'required|exists:users,id',
            'author' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $filePath;
        }

        Document::create($validated);

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = Document::with(['comments.user.profile'])->findOrFail($id);
        return view('super_admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $users = User::all();
        return view('super_admin.documents.edit', compact('document', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4',
            'keywords' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,zip,doc,docx,txt|max:10240', // 10 MB
            'user_id' => 'required|exists:users,id',
            'author' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
        ]);

        $document = Document::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $filePath;
        }

        $document->update($validated);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Handle the submission of comments and ratings.
     */
    /**
 * Handle the submission of comments and ratings.
 */
public function storeFeedback(Request $request)
{
    $validated = $request->validate([
        'document_id' => 'required|exists:documents,id',
        'content' => 'required|string|max:500', // Comment content
        'rating' => 'required|integer|min:1|max:5', // Rating
    ]);

    // Save the comment
    Comment::create([
        'document_id' => $validated['document_id'],
        'user_id' => auth()->id(),
        'content' => $validated['content'],
        'rating' => $validated['rating'],
    ]);


    return redirect()->back()->with('success', 'Your comment and rating have been submitted successfully.');
}


    /**
     * Download the specified document.
     */
    public function download($id)
{
    $document = Document::findOrFail($id);

    // Path to the file in storage
    $filePath = public_path('storage/' . $document->file_path);

    if (file_exists($filePath)) {
        // Return the file for download
        return response()->download($filePath, $document->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    return redirect()->back()->with('error', 'Document file not found.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
