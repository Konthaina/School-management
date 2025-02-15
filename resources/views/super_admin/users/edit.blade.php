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

        .form-group input, .form-group select {
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
        .btn-back {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    <div class="py-12">
        <div class="form-container">
            <h2 class="text-xl font-bold mb-4">Edit User</h2>
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password <small>(Leave blank to keep current password)</small></label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select id="role_id" name="role_id" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container">
                    <a href="{{ route('users.index') }}" class="btn-back">Back to Users</a>
                <button type="submit" class="btn-submit">Update User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
