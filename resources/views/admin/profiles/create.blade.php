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
        input, select, textarea {
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
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>

    <div class="py-12">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-6">Create Profile</h2>

            <!-- Form Validation Errors -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- User Selection Restricted for Admin -->
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" required>
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            @if(auth()->user()->role_id === 5 || (auth()->user()->role_id === 4 && $user->role_id !== 5))
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role->name }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" rows="3">{{ old('bio') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture">
                </div>

                <div class="btn-container">
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
