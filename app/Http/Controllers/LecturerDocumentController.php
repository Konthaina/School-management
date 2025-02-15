<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class LecturerDocumentController extends Controller
{
    /**
     * Display a listing of the lecturer's documents.
     */
    public function index()
    {
        $documents = Document::where('user_id', auth()->id())->get();
        return view('lecturer.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        return view('lecturer.documents.create');
    }

    /**
     * Store a newly created document.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4',
            'keywords' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,zip,doc,docx,txt|max:10240',
            'author' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $filePath;
        }

        $validated['user_id'] = auth()->id();

        Document::create($validated);

        return redirect()->route('lecturer.documents.index')->with('success', 'Document created successfully.');
    }

    /**
     * Show a single document owned by the lecturer.
     */
    public function show($id)
    {
        $document = Document::where('user_id', auth()->id())->findOrFail($id);
        return view('lecturer.documents.show', compact('document'));
    }

    /**
     * Show the form for editing a lecturer's document.
     */
    public function edit($id)
    {
        $document = Document::where('user_id', auth()->id())->findOrFail($id);
        return view('lecturer.documents.edit', compact('document'));
    }

    /**
     * Update a document owned by the lecturer.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4',
            'keywords' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,zip,doc,docx,txt|max:10240',
            'author' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
        ]);

        $document = Document::where('user_id', auth()->id())->findOrFail($id);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $filePath;
        }

        $document->update($validated);

        return redirect()->route('lecturer.documents.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Delete a document owned by the lecturer.
     */
    public function destroy($id)
    {
        $document = Document::where('user_id', auth()->id())->findOrFail($id);
        $document->delete();

        return redirect()->route('lecturer.documents.index')->with('success', 'Document deleted successfully.');
    }
}
