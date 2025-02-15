<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .bg-custom-active {
        background-color: #1f2937; /* New background color for the active menu */
    }

    .sidebar {
        height: 90vh; /* Set the height to 90% of the viewport */
        overflow-y: auto; /* Allow vertical scrolling if content exceeds 90vh */
    }
</style>

<div class="bg-gray-900 text-gray-200 sidebar w-64">
    <!-- Navigation Menu -->
    <nav class="mt-0">
        <ul class="space-y-4 px-6 pt-4">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('super_admin.dashboard') }}"
                   class="flex items-center {{ request()->routeIs('dashboard') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-tachometer-alt h-6 w-6 mr-3"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <!-- Manage Document -->
            <li>
                <a href="{{ route('documents.index') }}"
                   class="flex items-center {{ request()->routeIs('manage.document') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-folder h-6 w-6 mr-3"></i>
                    <span class="font-medium">Manage Document</span>
                </a>
            </li>

            <!-- Manage Users -->
            <li>
                <a href="{{ route('users.index') }}"
                   class="flex items-center {{ request()->routeIs('users.index') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-users h-6 w-6 mr-3"></i>
                    <span class="font-medium">Manage Users</span>
                </a>
            </li>

            <!-- Manage Comments -->
            <li>
                <a href="{{ route('comments.index') }}"
                   class="flex items-center {{ request()->routeIs('manage.comments') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-comments h-6 w-6 mr-3"></i>
                    <span class="font-medium">Manage Comments</span>
                </a>
            </li>

            <!-- Manage Profiles -->
            <li>
                <a href="{{ route('profiles.index') }}"
                   class="flex items-center {{ request()->routeIs('manage.profiles') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-user-circle h-6 w-6 mr-3"></i>
                    <span class="font-medium">Manage Profiles</span>
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="{{ route('settings.index') }}"
                   class="flex items-center {{ request()->routeIs('settings') ? 'bg-custom-active text-white' : 'text-blue-500' }} hover:bg-gray-700 px-4 py-3 rounded-lg transition">
                    <i class="fas fa-cogs h-6 w-6 mr-3"></i>
                    <span class="font-medium">Settings</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
