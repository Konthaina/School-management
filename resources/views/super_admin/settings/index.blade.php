<style>
    .button {
        background-color: #c03131; /* Default red color */
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-flex; /* Ensure consistent alignment */
        justify-content: center; /* Center the text */
        align-items: center; /* Center the text vertically */
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        width: 150px; /* Fixed width */
        height: 45px; /* Fixed height to ensure consistency */
        box-sizing: border-box;
    }

    .button:hover {
        opacity: 0.9; /* Subtle hover effect */
    }

    .button1 {
        background-color: #000000; /* Red */
    }

    .button2 {
        background-color: #002583; /* Green */
    }
    .container {
        max-width: 800px;
        background-color:white;
        margin: 0 auto;
        padding: 20px;
        height: 100%;
        border-radius: 10px;
    }
</style>

<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">System Settings</h1>

    <div class="flex space-x-4">
        <!-- Profile Button -->
        <a href="{{ route('profile.edit') }}" class="button button2">
            {{ __('Profile') }}
        </a>

        <!-- Log Out Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" class="button button1">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
    </div>
</x-app-layout>
