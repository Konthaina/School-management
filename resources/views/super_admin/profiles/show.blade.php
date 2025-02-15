<x-app-layout>
    <style>
        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profile-details {
            font-size: 16px;
            line-height: 1.5;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-top: 16px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="profile-container">
                @if ($profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="profile-picture">
                @else
                    <p>No profile picture uploaded.</p>
                @endif
                <div class="profile-details">
                    <p><strong>User:</strong> {{ $profile->user->name }}</p>
                    <p><strong>Phone Number:</strong> {{ $profile->phone_number }}</p>
                    <p><strong>Address:</strong> {{ $profile->address }}</p>
                    <p><strong>Date of Birth:</strong> {{ $profile->date_of_birth }}</p>
                </div>
                <a href="{{ route('profiles.index') }}" class="back-button">Back to Profiles</a>
            </div>
        </div>
    </div>
</x-app-layout>
