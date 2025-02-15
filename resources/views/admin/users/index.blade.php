<x-app-layout>
    <style>
        .user-management-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .user-management-table th, .user-management-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .user-management-table th {
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

        .view-button { background-color: #007bff; }
        .edit-button { background-color: #ffc107; }
        .delete-button { background-color: #dc3545; }

        .action-button:hover { opacity: 0.9; }

    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Users</h2>
                    <a href="{{ route('admin.users.create') }}"
                       style="background-color: #000; color: #fff; padding: 8px 16px; border-radius: 4px; text-decoration: none;">
                        Create User
                    </a>
                    @if(auth()->user()->role->name === 'Super Admin')
                        <a href="{{ route('admin.users.create') }}"
                           style="background-color: #000; color: #fff; padding: 8px 16px; border-radius: 4px; text-decoration: none;">
                            Create User
                        </a>
                    @endif
                    <table class="user-management-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td class="actions-column">
                                        {{-- Everyone can view --}}
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="action-button view-button">
                                            View
                                        </a>
                                        {{-- Only Super Admin can edit or delete Super Admins --}}
                                        @if(
                                            auth()->user()->role->name === 'Super Admin' ||
                                            $user->role->name !== 'Super Admin'
                                        )
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="action-button edit-button">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
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
