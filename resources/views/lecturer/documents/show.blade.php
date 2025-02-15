<x-app-layout>
    <style>
        /* Custom styles for the document details */
        .document-details {
            margin-top: 2rem;
            padding: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .document-details h3 {
            margin-bottom: 16px;
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 2px solid #ccc;
            padding-bottom: 8px;
        }

        .document-details p {
            margin: 8px 0;
            font-size: 1rem;
        }

        .action-buttons {
            margin-top: 16px;
        }

        .action-button {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 8px;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-button {
            background-color: #ffc107;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .download-button {
            background-color: #28a745;
        }

        .action-button:hover {
            opacity: 0.9;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Document Details</h2>

                    <div class="document-details">
                        <h3>{{ $document->name }}</h3>
                        <p><strong>Publication Year:</strong> {{ $document->publication_year }}</p>
                        <p><strong>Author:</strong> {{ $document->author ?? 'N/A' }}</p>
                        <p><strong>Field:</strong> {{ $document->field ?? 'N/A' }}</p>
                        <p><strong>Genre:</strong> {{ $document->genre ?? 'N/A' }}</p>
                        <p><strong>Keywords:</strong> {{ $document->keywords ?? 'N/A' }}</p>
                        <p><strong>Uploaded By:</strong> {{ $document->user->name ?? 'Unknown' }}</p>
                        <p><strong>File:</strong>
                            <a href="{{ asset('storage/' . $document->file_path) }}" class="action-button download-button" download>
                                Download File
                            </a>
                        </p>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('lecturer.documents.index') }}"
                        style="background-color: #000; color: #fff; border: 1px solid #fff; padding: 8px 16px; border-radius: 4px; text-decoration: none; display: inline-block; margin-bottom: 16px;">
                            Back
                        </a>

                        <a href="{{ route('lecturer.documents.edit', $document->id) }}" class="action-button edit-button">Edit</a>

                        <form action="{{ route('lecturer.documents.destroy', $document->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
