<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Profile Details</h2>

                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <img src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : asset('images/default-profile.png') }}"
                             alt="Profile Picture"
                             class="w-32 h-32 rounded-full object-cover">
                    </div>

                    <div class="flex-grow">
                        <p class="text-lg"><strong>Name:</strong> {{ $profile->user->name }}</p>
                        <p class="text-lg"><strong>Email:</strong> {{ $profile->user->email }}</p>
                        <p class="text-lg"><strong>Phone Number:</strong> {{ $profile->phone_number ?? 'N/A' }}</p>
                        <p class="text-lg"><strong>Address:</strong> {{ $profile->address ?? 'N/A' }}</p>
                        <p class="text-lg"><strong>Date of Birth:</strong> {{ $profile->date_of_birth ?? 'N/A' }}</p>
                        <p class="text-lg"><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.profiles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
