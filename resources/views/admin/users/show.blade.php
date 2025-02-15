<style>
    /* Custom styles for the user details page */

body {
    background-color: #f3f4f6; /* Light gray background */
    font-family: 'Arial', sans-serif; /* Use a clean, modern font */
    color: #4a5568; /* Dark gray text */
}

.form-container {
    background-color: #ffffff; /* White background */
    border-radius: 0.5rem; /* Rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 1.5rem; /* Inner spacing */
    margin-top: 1rem; /* Top margin */
}

.form-container h2 {
    font-size: 2rem; /* Large heading font */
    font-weight: 700; /* Bold */
    color: #2d3748; /* Darker gray for the heading */
    border-bottom: 2px solid #e2e8f0; /* Light gray border */
    padding-bottom: 0.5rem; /* Space below heading */
    margin-bottom: 1rem; /* Space after heading */
}

.form-container .text-gray-700 p {
    margin-bottom: 0.75rem; /* Spacing between details */
    font-size: 1rem; /* Default text size */
    line-height: 1.5; /* Comfortable line spacing */
}

.form-container .text-gray-700 p strong {
    color: #1a202c; /* Slightly darker color for strong emphasis */
    font-weight: bold; /* Bold text for labels */
}

a.inline-block {
    display: inline-block; /* Inline block for proper padding */
    background-color: #3182ce; /* Blue background */
    color: white; /* White text */
    padding: 0.75rem 1.5rem; /* Button padding */
    border-radius: 0.375rem; /* Rounded corners */
    font-size: 0.875rem; /* Small text size */
    font-weight: 600; /* Semi-bold text */
    text-decoration: none; /* Remove underline */
    transition: all 0.2s ease-in-out; /* Smooth transitions */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

a.inline-block:hover {
    background-color: #2b6cb0; /* Darker blue on hover */
    transform: translateY(-2px); /* Lift effect */
}

a.inline-block:focus {
    outline: none; /* Remove outline */
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.5); /* Focus ring */
}

</style>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="form-container">
                <h2>User Details</h2>
                <div class="text-gray-700">
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->role->name }}</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.users.index') }}" class="inline-block">
                        Back to Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
