<!-- Sidebar with Collapse Toggle -->
<aside id="sidebar" class="w-64 bg-gradient-to-b from-gray-600 to-gray-700 text-white flex-shrink-0 border-r border-gray-800 transition-all duration-300">
    <!-- Logo Section -->
    <div class="p-4 border-b border-gray-800 flex items-center justify-between">
        <div id="logoText" class="flex items-center gap-3 flex-1 min-w-0">
            <div class="min-w-0">
                <h1 class="text-xl font-bold text-white truncate">Admin Panel</h1>
            </div>
        </div>
        <button id="toggleSidebar" class="p-2 hover:bg-gray-800 rounded-sm transition-colors flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav id="sidebarNav" class="px-3 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" title="Dashboard"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(Route::currentRouteName() === 'admin.dashboard') bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <span class="menuText font-medium">Dashboard</span>
        </a>

        <!-- About -->
        <a href="{{ route('admin.about.index') }}" title="About"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.about')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="menuText font-medium">About</span>
        </a>

        <!-- Skills -->
        <a href="{{ route('admin.skills.index') }}" title="Skills"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.skills')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4m0 6v2m0 0v2m0-2h2m-2 0h-2m6-4l4 4M9 9l4-4"></path>
            </svg>
            <span class="menuText font-medium">Skills</span>
        </a>

        <!-- Categories -->
        <a href="{{ route('admin.categories.index') }}" title="Categories"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.categories')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
            </svg>
            <span class="menuText font-medium">Categories</span>
        </a>

        <!-- Interests -->
        <a href="{{ route('admin.interests.index') }}" title="Interests"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.interests')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <span class="menuText font-medium">Interests</span>
        </a>

        <!-- Resume -->
        <a href="{{ route('admin.resume.index') }}" title="Resume"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.resume')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="menuText font-medium">Resume</span>
        </a>

        <!-- Services -->
        <a href="{{ route('admin.services.index') }}" title="Services"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.services')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.597-9-1.688m0 0a23.911 23.911 0 017.08-3.85m0 0A24.02 24.02 0 015 12c0 1.052.015 2.102.072 3.148m16.856-4.958A24.048 24.048 0 0112 12.75c-3.184 0-6.219-.597-9-1.688m0 0A23.882 23.882 0 0120.979 8.25m0 0A23.881 23.881 0 0012 8.25m0 0A23.911 23.911 0 013.021 15.75m21.958-5.25c-3.182 0-6.22.595-9 1.688"></path>
            </svg>
            <span class="menuText font-medium">Services</span>
        </a>

        <!-- Portfolio -->
        <a href="{{ route('admin.portfolio.index') }}" title="Portfolio"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.portfolio')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="menuText font-medium">Portfolio</span>
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.contact.index') }}" title="Messages"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.contact')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="menuText font-medium">Messages</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('admin.settings.index') }}" title="Settings"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-sm @if(str_contains(Route::currentRouteName(), 'admin.settings')) bg-gradient-to-r from-green-600 to-green-500 shadow-lg shadow-green-500/30 @else text-gray-300 hover:bg-gray-800 hover:text-white @endif transition-all duration-300 group relative">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="menuText font-medium">Settings</span>
        </a>
    </nav>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const logoText = document.getElementById('logoText');
    const menuTexts = document.querySelectorAll('.menuText');
    const tooltips = document.querySelectorAll('.tooltip');
    const navItems = document.querySelectorAll('.navItem');

    // Function to set collapsed state
    function setCollapsed(isCollapsed) {
        if (isCollapsed) {
            // Collapsed state - width 20 (w-20)
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-20');

            // Hide logo text
            logoText.classList.add('hidden');

            // Hide all menu texts
            menuTexts.forEach(el => {
                el.classList.add('hidden');
            });

            // Show tooltips on hover
            tooltips.forEach(el => {
                el.style.display = 'block';
            });

            // Center align nav items
            navItems.forEach(el => {
                el.classList.add('justify-center');
                el.classList.remove('justify-start');
            });

            localStorage.setItem('sidebarState', 'collapsed');
        } else {
            // Expanded state - width 64 (w-64)
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-64');

            // Show logo text
            logoText.classList.remove('hidden');

            // Show all menu texts
            menuTexts.forEach(el => {
                el.classList.remove('hidden');
            });

            // Hide tooltips
            tooltips.forEach(el => {
                el.style.display = 'none';
            });

            // Left align nav items
            navItems.forEach(el => {
                el.classList.remove('justify-center');
                el.classList.add('justify-start');
            });

            localStorage.setItem('sidebarState', 'expanded');
        }
    }

    // Load saved state from localStorage
    const savedState = localStorage.getItem('sidebarState');
    if (savedState === 'collapsed') {
        setCollapsed(true);
    } else {
        setCollapsed(false);
    }

    // Toggle button click
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isCurrentlyCollapsed = sidebar.classList.contains('w-20');
            setCollapsed(!isCurrentlyCollapsed);
        });
    }
});
</script>
