<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #343a40;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Card Styles */
        .card-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        .card i {
            font-size: 2rem;
        }

        .documents { background-color: #e3f2fd; border: 1px solid #007bff; }
        .users { background-color: #fff3cd; border: 1px solid #ffc107; }
        .comments { background-color: #d4edda; border: 1px solid #28a745; }

        .card-value { font-size: 2rem; font-weight: bold; }
        .card-delta { font-size: 0.9rem; color: #6c757d; }

        /* Search and Filter */
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            width: 300px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        /* Tabs */
        .tabs-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .tabs {
            display: flex;
            gap: 20px;
        }

        .tab {
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background-color: #f1f3f5;
            color: #343a40;
        }

        .tab.active {
            background-color: #007bff;
            color: white;
        }

        .sort-dropdown {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 1rem;
            width: 200px;
        }

        /* Document List */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f1f3f5;
        }

        .tag {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .tag.book { background: #ffe3e3; color: #d6336c; }
        .tag.lesson { background: #d4edda; color: #28a745; }
        .tag.revision { background: #fff3cd; color: #ffc107; }
        .f1 { color: #007bff; }
        .f2 { color: #ffc107; }
        .f3 { color: #28a745; }

        /* Center-align specific table columns */
        table th:nth-child(2),
        table th:nth-child(3),
        table th:nth-child(4),
        table td:nth-child(2),
        table td:nth-child(3),
        table td:nth-child(4) {
            text-align: center;
        }

        table td:nth-child(4) {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <!-- Main Container -->
    <div class="container">
        <!-- Cards Section -->
        <div class="card-container">
            <div class="card documents">
                <i class="fas f1 fa-file-alt"></i>
                <div>
                    <div class="card-value">{{ $documentCount }}</div>
                    <div class="card-delta">+{{ $documentCountDelta ?? 0 }} from yesterday</div>
                </div>
            </div>
            <div class="card users">
                <i class="fas f2 fa-users"></i>
                <div>
                    <div class="card-value">{{ $userCount }}</div>
                    <div class="card-delta">+{{ $userCountDelta ?? 0 }} from yesterday</div>
                </div>
            </div>
            <div class="card comments">
                <i class="fas f3 fa-comments"></i>
                <div>
                    <div class="card-value">{{ $commentCount }}</div>
                    <div class="card-delta">+{{ $commentCountDelta ?? 0 }} from yesterday</div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-container">
            <form action="{{ route('super_admin.dashboard') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Search documents..."
                    value="{{ request('search') }}"
                >
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        <!-- Tabs and Sort Section -->
        <div class="tabs-container">
            <div class="tabs">
                <a href="{{ route('super_admin.dashboard', ['sort_by' => 'created_at']) }}"
                   class="tab {{ request('sort_by', 'created_at') === 'created_at' ? 'active' : '' }}">
                   Newest
                </a>
                <a href="{{ route('super_admin.dashboard', ['sort_by' => 'name']) }}"
                   class="tab {{ request('sort_by') === 'name' ? 'active' : '' }}">
                   All
                </a>
            </div>
            <form action="{{ route('super_admin.dashboard') }}" method="GET">
                <select name="sort_by" class="sort-dropdown" onchange="this.form.submit()">
                    <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Sort by: Newest</option>
                    <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>Sort by: Title</option>
                    <option value="publication_year" {{ request('sort_by') === 'publication_year' ? 'selected' : '' }}>Sort by: Year</option>
                </select>
                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>
        </div>

        <!-- Documents List Section -->
        <table>
            <thead>
                <tr>
                    <th>Document Title</th>
                    <th>Type</th>
                    <th>Publication Year</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDocuments as $document)
                <tr>
                    <td>
                        <a href="{{ route('documents.show', $document->id) }}" style="color: #007bff; text-decoration: none;">
                            {{ $document->name }}
                        </a>
                    </td>
                    <td>
                        @if($document->genre === 'book')
                            <span class="tag book">Book</span>
                        @elseif($document->genre === 'lesson')
                            <span class="tag lesson">Lesson</span>
                        @else
                            <span class="tag revision">Revision</span>
                        @endif
                    </td>
                    <td>{{ $document->publication_year }}</td>
                    <td>
                        @if($document->user && $document->user->profile)
                            <img src="{{ asset('storage/' . $document->user->profile->profile_picture) }}"
                                 alt="User" style="border-radius: 50%; width: 32px; height: 32px;">
                        @else
                            <img src="https://via.placeholder.com/32" alt="User" style="border-radius: 50%;">
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No documents found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
