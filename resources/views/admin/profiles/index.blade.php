<x-app-layout>
    <style>
        /* Custom styles for the table */
        .profile-management-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .profile-management-table th, .profile-management-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .profile-management-table th {
            background-color: #f4f4f4;
        }

        .actions-column {
            width: 230px;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
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

        .pro-box {
            width: 60px;
            height: auto;
            align-items: center;
        }

        .create-profile-btn {
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 16px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Manage User Profiles</h2>

                    <a href="{{ route('admin.profiles.create') }}" class="create-profile-btn">
                        Create Profile
                    </a>
                    @if(auth()->user()->role_id === 5)
                        <a href="{{ route('admin.profiles.create') }}" class="create-profile-btn">
                            Create Profile
                        </a>
                    @endif

                    <table class="profile-management-table">
                        <thead>
                            <tr>
                                <th class="pro-box">Profile</th>
                                <th>ID</th>
                                <th>User</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Date of Birth</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profiles as $profile)
                                <tr>
                                    <td class="pro-box">
                                        <img src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : asset('images/default-profile.png') }}"
                                             alt="Profile Picture"
                                             class="profile-picture">
                                    </td>
                                    <td>{{ $profile->id }}</td>
                                    <td>{{ $profile->user->name }}</td>
                                    <td>{{ $profile->phone_number }}</td>
                                    <td>{{ $profile->address }}</td>
                                    <td>{{ $profile->date_of_birth }}</td>
                                    <td class="actions-column">
                                        <!-- 'View' is available for everyone -->
                                        <a href="{{ route('admin.profiles.show', $profile->id) }}" class="action-button view-button">
                                            View
                                        </a>

                                        <!-- Admin can edit anyone except Super Admin -->
                                        @if(auth()->user()->role_id === 5 ||
                                            (auth()->user()->role_id === 4 && $profile->user->role_id !== 5))
                                            <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="action-button edit-button">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.profiles.destroy', $profile->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
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
