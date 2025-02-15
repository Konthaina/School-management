<x-app-layout>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .profile-preview {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        .profile-preview img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
        }
    </style>

    <div class="py-12">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

            <!-- Validation Error Display -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $profile->phone_number) }}">
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $profile->address) }}">
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth) }}">
                </div>

                <!-- Bio -->
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" rows="3">{{ old('bio', $profile->bio) }}</textarea>
                </div>

                <!-- Profile Picture -->
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture">

                    <div class="profile-preview">
                        @if ($profile->profile_picture)
                            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture">
                            <span>Current Picture</span>
                        @else
                            <span>No Profile Picture</span>
                        @endif
                    </div>
                </div>

                <!-- Button Container -->
                <div class="btn-container">
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
