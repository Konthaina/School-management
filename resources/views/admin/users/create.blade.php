<x-app-layout>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container label {
            font-size: 1rem;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            background-color: #f9f9f9;
        }

        .form-container select {
            background-color: #f9f9f9;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .form-container .form-footer {
            text-align: center;
            margin-top: 15px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 form-container">
                    <h2 class="text-2xl font-bold mb-6">Create User</h2>
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <label for="role_id">Role</label>
                            <select id="role_id" name="role_id" required>
                                @foreach($roles as $role)
                                    {{-- Only show "Super Admin" to logged-in super admins --}}
                                    @if(auth()->user()->role->name === 'Super Admin' || $role->name !== 'Super Admin')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit">Create</button>
                        </div>
                    </form>
                    <div class="form-footer">
                        <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700">Back to User List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
