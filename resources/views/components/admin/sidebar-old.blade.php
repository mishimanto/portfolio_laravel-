<!-- Sidebar with Collapse Toggle -->
<!-- Sidebar -->
<aside id="sidebar"
    class="w-64 bg-gradient-to-b from-gray-950 to-gray-900 text-white flex-shrink-0 border-r border-gray-800 transition-all duration-300">

    <!-- Logo -->
    <div class="p-4 border-b border-gray-800 flex items-center justify-between">
        <div id="logoText" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center font-bold text-lg">
                A
            </div>
            <div>
                <h1 class="text-sm font-bold">Admin</h1>
                <p class="text-xs text-gray-400">Panel</p>
            </div>
        </div>

        <!-- Toggle Button -->
        <button id="toggleSidebar" class="p-2 hover:bg-gray-800 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Menu -->
    <nav class="px-3 py-4 space-y-1">

        <!-- Item -->
        <a href="{{ route('admin.dashboard') }}"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 group relative">

            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>

            <span class="menuText font-medium">Dashboard</span>

            <!-- Tooltip -->
            <span
                class="tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-xs rounded hidden group-hover:block whitespace-nowrap">
                Dashboard
            </span>
        </a>

        <!-- About -->
        <a href="{{ route('admin.about.index') }}"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 group relative">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path>
            </svg>

            <span class="menuText">About</span>

            <span
                class="tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-xs rounded hidden group-hover:block">
                About
            </span>
        </a>

        <!-- Skills -->
        <a href="{{ route('admin.skills.index') }}"
            class="navItem flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-800 group relative">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2"
                    d="M10 20l4-16m4 4l4 4m0 6v2m0 0v2m0-2h2m-2 0h-2">
                </path>
            </svg>

            <span class="menuText">Skills</span>

            <span
                class="tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-xs rounded hidden group-hover:block">
                Skills
            </span>
        </a>

        <!-- Add others same way -->
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
