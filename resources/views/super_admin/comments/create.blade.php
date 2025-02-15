<style>
    /* General styles for form container */
    .form-container {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 1rem;
    }

    /* Form heading */
    .form-heading {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1a202c;
    }

    /* Labels */
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    /* Inputs and Selects */
    .form-input,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        background-color: #f7fafc;
        font-size: 1rem;
        color: #2d3748;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.3);
        outline: none;
    }

    /* Textarea */
    .form-textarea {
        resize: vertical;
    }

    /* Button */
    .form-button {
        display: inline-block;
        background-color: #3182ce;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s, transform 0.1s;
        cursor: pointer;
    }

    .form-button:hover {
        background-color: #2b6cb0;
        transform: scale(1.02);
    }

    .form-button:active {
        background-color: #225e99;
    }

    /* Responsive design */
    @media (max-width: 640px) {
        .form-container {
            padding: 1rem;
        }

        .form-heading {
            font-size: 1.25rem;
        }
    }
</style>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="form-container">
                <h2 class="form-heading">Create New Comment</h2>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="document_id" class="form-label">Document</label>
                        <select id="document_id" name="document_id" class="form-select">
                            @foreach ($documents as $document)
                                <option value="{{ $document->id }}">{{ $document->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="form-label">User</label>
                        <input type="text" name="user_id" id="user_id" value="{{ auth()->user()->id }}" class="form-input" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="content" name="content" rows="4" class="form-input form-textarea" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" class="form-input">
                    </div>
                    <a href="{{ route('comments.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md">Back to Comments</a>
                    <button type="submit" class="form-button">Save Comment</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
