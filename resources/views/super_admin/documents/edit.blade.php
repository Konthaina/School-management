<x-app-layout>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-submit {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }
    </style>

    <div class="py-12">
        <div class="form-container">
            <h2 class="text-xl font-bold mb-4">Edit Document</h2>
            <form method="POST" action="{{ route('documents.update', $document->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $document->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="publication_year">Publication Year</label>
                    <input type="number" id="publication_year" name="publication_year" value="{{ old('publication_year', $document->publication_year) }}" required>
                </div>
                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <textarea id="keywords" name="keywords">{{ old('keywords', $document->keywords) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $document->author) }}">
                </div>
                <div class="form-group">
                    <label for="field">Field</label>
                    <input type="text" id="field" name="field" value="{{ old('field', $document->field) }}">
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" value="{{ old('genre', $document->genre) }}">
                </div>
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">Select a User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $document->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Upload New File</label>
                    <input type="file" id="file" name="file">
                    @if($document->file_path)
                        <small>Current File: <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View File</a></small>
                    @endif
                </div>
                <a href="{{ route('documents.index') }}" class="btn-cancel">Back</a>
                <button type="submit" class="btn-submit">Update Document</button>
            </form>
        </div>
    </div>
</x-app-layout>
