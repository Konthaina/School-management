<x-app-layout>
    <style>
        /* General Table Styles */
        .document-detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .document-detail-table th, .document-detail-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .document-detail-table th {
            background-color: #f4f4f4;
        }

        /* Scrollable Box */
        .scroll-box {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
        }

        /* Form and Button Styles */
        .form-control {
            border-radius: 10px;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Comments Section */
        .comment-box {
            margin-top: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .comments-section {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .comment-item {
            display: flex;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }

        .comment-content {
            flex: 1;
        }

        .star-rating {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        .star-rating .star {
            font-size: 24px;
            cursor: pointer;
            color: #ddd;
        }

        .star-rating .star.selected {
            color: #ffd700; /* Gold color for selected stars */
        }

        .star {
            color: #ffd700;
        }
        .unsupported-file-message{
            color: red;
            font-size: 18px;
            font-weight: bold;
        }
        .document-detail-table{
            display: flex;
            justify-content: space-between;
        }
        .profile{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profile img{
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Document Details -->
                    <div class="profile">
                        <h2 class="text-2xl font-bold mb-4">{{ $document->name }}</h2>
                        <img
                        src="{{ $document->user->profile && $document->user->profile->profile_picture
                        ? asset('storage/' . $document->user->profile->profile_picture)
                        : asset('storage/default-profile.png') }}"
                        alt="Profile Picture"
                        >
                    </div>


                    <div class="document-detail-table">
                        <div class="info">
                            <p><strong>Publication Year:</strong> {{ $document->publication_year }}</p>
                            <p><strong>Field:</strong> {{ $document->field }}</p>
                            <p><strong>Author:</strong> {{ $document->author }}</p>
                        </div>
                        <div class="details">
                            <p><strong>Post Date:</strong> {{ $document->created_at->format('Y-m-d') }}</p>
                            <p><strong>Genre:</strong> {{ $document->genre}}</p>
                            <p><strong>Keyword:</strong> {{ $document->keywords }}</p>
                        </div>
                    </div>
                    <!-- Check and display the content based on file type -->
                    @php
                        $fileExtension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                    @endphp

                    @if($fileExtension == 'pdf')
                        <!-- PDF Button to View Document -->
                        <a href="{{ asset('storage/' . $document->file_path) }}" class="btn btn-primary mb-3" target="_blank">
                            View PDF Document
                        </a>
                    @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <!-- Image Display -->
                        <img src="{{ asset('storage/' . $document->file_path) }}" class="img-fluid mb-3" alt="Document Image">
                    @elseif($fileExtension == 'txt')
                        <!-- Text File Display -->
                        <div class="scroll-box mb-3">
                            <pre>{{ file_get_contents(storage_path('app/public/' . $document->file_path)) }}</pre>
                        </div>
                    @else
                        <!-- Unsupported File Message -->
                        <p class="unsupported-file-message">File format not supported for viewing.</p>
                    @endif
                    <!-- Download Button -->
                    <a href="{{ route('document.download', $document->id) }}" class="btn btn-primary mb-3">
                        Download Document
                    </a>

                    <!-- Comments Section -->
                    <div class="mt-5">
                        <h4>Comments</h4>
                        <div class="comments-section">
                            @foreach($document->comments as $comment)
                                <div class="comment-item">
                                    <!-- Profile Picture -->
                                    <img
                                        src="{{ $comment->user->profile && $comment->user->profile->profile_picture
                                        ? asset('storage/' . $comment->user->profile->profile_picture)
                                        : asset('storage/default-profile.png') }}"
                                        alt="Profile Picture"
                                    >

                                    <!-- Comment Content -->
                                    <div class="comment-content">
                                        <p><strong>{{ $comment->user->name }}</strong>
                                           <span style="color: #888; font-size: 14px;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                        <p>{{ $comment->content }}</p>
                                        <div class="star-rating">
                                            @if ($comment->rating == 1)
                                                <span class="star selected">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                            @elseif ($comment->rating == 2)
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                            @elseif ($comment->rating == 3)
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                            @elseif ($comment->rating == 4)
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star">★</span>
                                            @elseif ($comment->rating == 5)
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                                <span class="star selected">★</span>
                                            @else
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                                <span class="star">★</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Comments and Evaluation Form -->
                    <div class="comment-box">
                        <h4>Leave a Comment and Rate the Document</h4>
                        @auth
                            <form action="{{ route('documents.storeFeedback', $document->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="document_id" value="{{ $document->id }}" />
                                <input type="hidden" id="rating-input" name="rating" value="0" />

                                <!-- Comment Section -->
                                <div class="form-group">
                                    <textarea name="content" class="form-control" placeholder="Add a comment..." required></textarea>
                                </div>

                                <!-- Star Rating Section -->
                                <div class="star-rating" id="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star" data-value="{{ $i }}">★</span>
                                    @endfor
                                </div>
                                <!-- Submit Button -->
                                <a href="{{ route('super_admin.dashboard') }}" class="btn-cancel">Back</a>
                                <button type="submit" class="btn btn-success mt-3">Submit Feedback</button>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Login</a> to leave a comment and rating.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star-rating .star');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const rating = star.getAttribute('data-value');
                    ratingInput.value = rating;

                    stars.forEach(s => {
                        s.classList.toggle('selected', s.getAttribute('data-value') <= rating);
                    });
                });
            });
        });
    </script>
</x-app-layout>
