<style>
    .comment-management-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .comment-management-table th, .comment-management-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .comment-management-table th {
        background-color: #f4f4f4;
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
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Comment Details</h2>
                    <div class="mb-4">
                        <strong>Document:</strong> {{ $comment->document->name }}
                    </div>
                    <div class="mb-4">
                        <strong>User:</strong> {{ $comment->user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Content:</strong>
                        <p>{{ $comment->content }}</p>
                    </div>
                    <div class="mb-4">
                        <strong>Rating:</strong> {{ $comment->rating ?? 'N/A' }}
                    </div>

                    <a href="{{ route('comments.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md">Back to Comments</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
