<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Prepare dashboard data for use in views.
     */
    private function prepareDashboardData(Request $request)
    {
        $search = $request->input('search'); // Get the search query
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at

        $documentCount = Document::count();
        $userCount = User::count();
        $commentCount = Comment::count();

        $documentCountDelta = 5; // Example: Replace with actual logic if available
        $userCountDelta = 8;    // Example: Replace with actual logic if available
        $commentCountDelta = 3; // Example: Replace with actual logic if available

        // Fetch documents with search and sorting
        $recentDocuments = Document::with('user.profile')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, 'desc')
            ->take(5)
            ->get();

        return compact(
            'documentCount', 'userCount', 'commentCount',
            'documentCountDelta', 'userCountDelta', 'commentCountDelta',
            'recentDocuments', 'search', 'sortBy'
        );
    }

    /**
     * Render the Super Admin dashboard.
     */
    public function index(Request $request)
    {
        $data = $this->prepareDashboardData($request);
        return view('super_admin.dashboard', $data);
    }

    /**
     * Render the dashboard for authenticated users.
     */
    public function dashboard(Request $request)
    {
        $data = $this->prepareDashboardData($request);
        return view('dashboard', $data); // Use 'dashboard' view
    }

    /**
     * Render the dashboard for outsiders (guest users) with restricted functionality.
     */
    public function outsiderDashboard(Request $request)
    {
        $data = $this->prepareDashboardData($request);

        // Indicate that this is an "outsider" view with restricted functionality
        $data['isReadOnly'] = true;

        return view('outsider.dashboard', $data); // Use 'outsider.dashboard' view
    }
}
