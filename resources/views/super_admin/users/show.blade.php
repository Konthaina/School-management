<x-app-layout>
    <style>
        .details-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .details-container h3 {
            margin-bottom: 1rem;
        }

        .details-group {
            margin-bottom: 1rem;
        }

        .details-label {
            font-weight: bold;
        }

        .details-value {
            margin-left: 10px;
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

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="py-12">
        <div class="details-container">
            <h3 class="text-xl font-bold">User Details</h3>
            <div class="details-group">
                <span class="details-label">Name:</span>
                <span class="details-value">{{ $user->name }}</span>
            </div>
            <div class="details-group">
                <span class="details-label">Email:</span>
                <span class="details-value">{{ $user->email }}</span>
            </div>
            <div class="details-group">
                <span class="details-label">Role:</span>
                <span class="details-value">{{ $user->role->name ?? 'N/A' }}</span>
            </div>
            <a href="{{ route('users.index') }}" class="btn-back">Back to Users</a>
        </div>
    </div>
</x-app-layout>
