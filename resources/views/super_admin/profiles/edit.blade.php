<x-app-layout>
    <style>
        /* Reuse the styles from Create */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        .submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .profile-picture {
            display: block;
            margin-bottom: 10px;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .btn-back {
            background-color: #ff2a00;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-back:hover {
            background-color: #b30c00;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="form-container">
                <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>
                <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $profile->phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $profile->address }}">
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $profile->date_of_birth }}">
                    </div>
                    <div class="form-group">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        @if ($profile->profile_picture)
                            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="profile-picture">
                        @endif
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    </div>
                    <a href="{{ route('profiles.index') }}" class="back-button">Back to Profiles</a>
                    <button type="submit" class="submit-button">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
