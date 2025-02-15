<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use App\Models\Comment;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $documents = Document::where('name', 'like', "%$query%")
            ->orWhere('keywords', 'like', "%$query%")
            ->get();

        // Fetching dynamic data for cards
        $documentCount = Document::count();
        $userCount = User::count();
        $commentCount = Comment::count();

        return view('super_admin.dashboard', compact('documents', 'documentCount', 'userCount', 'commentCount'));
    }
}
