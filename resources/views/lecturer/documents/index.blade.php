<x-app-layout>
    <style>
        /* Reuse the table and button styles */
        .document-management-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .document-management-table th, .document-management-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .document-management-table th {
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Your Documents</h2>
                    <a href="{{ route('lecturer.documents.create') }}"
                       style="background-color: #000; color: #fff; border: 1px solid #fff; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block; margin-bottom: 16px;">
                        Add New Document
                    </a>
                    <table class="document-management-table">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Publication Year</th>
                                <th>Field</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $document->publication_year }}</td>
                                    <td>{{ $document->field }}</td>
                                    <td class="actions-column">
                                        <a href="{{ route('lecturer.documents.show', $document->id) }}" class="action-button view-button">
                                            View
                                        </a>
                                        <a href="{{ route('lecturer.documents.edit', $document->id) }}" class="action-button edit-button">
                                            Edit
                                        </a>
                                        <form action="{{ route('lecturer.documents.destroy', $document->id) }}" method="POST" style="display: inline;">
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
</x-app-layout>
