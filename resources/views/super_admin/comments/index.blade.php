<x-app-layout>
    <style>
        .table-container {
            max-height: 400px; /* Set the height for scroll */
            overflow-y: auto; /* Enable vertical scrolling */
            border: 1px solid #ccc; /* Add a border for the container */
            padding: 0; /* Remove extra padding */
            margin: 0; /* Remove external margins */
            border-radius: 8px; /* Optional for rounded look */
            background-color: #f9f9f9; /* Optional */
        }

        .comment-management-table {
            width: 100%;
            border-collapse: collapse; /* Prevent spacing between cells and borders */
            margin: 0; /* Remove margin on table */
        }

        .comment-management-table th,
        .comment-management-table td {
            border: 1px solid #ccc; /* Table cell borders */
            padding: 8px; /* Padding inside cells */
            text-align: left; /* Align text to the left */
        }

        .comment-management-table th {
            background-color: #f4f4f4; /* Header background color */
            position: sticky; /* Sticky header to stay visible during scrolling */
            top: 0; /* Position at the top */
            z-index: 2; /* Ensure it stays above other content */
        }

        .actions-column {
            width: 230px;
        }

        .action-button {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 4px;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .view-button {
            background-color: #007bff;
        }

        .edit-button {
            background-color: #ffc107;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .action-button:hover {
            opacity: 0.9;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Comments Management</h2>
                    <a href="{{ route('comments.create') }}"
                       style="background-color: #000; color: #fff; border: 1px solid #fff; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block; margin-bottom: 16px;">
                        Add New Comment
                    </a>
                    <div class="table-container">
                        <table class="comment-management-table">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Content</th>
                                    <th class="actions-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->document->name }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td>{{ $comment->rating ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($comment->content, 50) }}</td>
                                        <td class="actions-column">
                                            <a href="{{ route('comments.show', $comment->id) }}" class="action-button view-button">
                                                View
                                            </a>
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="action-button edit-button">
                                                Edit
                                            </a>
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
