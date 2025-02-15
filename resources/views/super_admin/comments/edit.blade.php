<style>
    /* Overall form container styling */
    .form-container {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Headline styles */
    .form-heading {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1a202c;
    }

    /* Label styles */
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Input and select styles */
    .form-input,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 0.375rem;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        font-size: 1rem;
        color: #2d3748;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        outline: none;
    }

    /* Textarea styles */
    .form-textarea {
        resize: none;
        font-family: inherit;
    }

    /* Button styles */
    .submit {
        background-color: #3182ce;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out, opacity 0.2s ease-in-out;
    }

    .submit:hover {
        background-color: #2b6cb0;
        opacity: 0.9;
    }

    /* Form spacing */
    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Edit Comment</h2>
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="document_id" class="block text-sm font-medium text-gray-700">Document</label>
                            <select id="document_id" name="document_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}" @if($document->id == $comment->document_id) selected @endif>{{ $document->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="content" name="content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ $comment->content }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <input type="number" id="rating" name="rating" min="1" max="5" value="{{ $comment->rating }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <a href="{{ route('comments.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md">Back to Comments</a>
                        <button type="submit" class="bg-blue-500 submit text-white py-2 px-4 rounded-md">Update Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
