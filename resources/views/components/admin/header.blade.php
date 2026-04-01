<!-- Header -->
<div class="bg-gradient-to-r from-blue-900 via-gray-800 to-blue-700 shadow-lg border-b border-gray-700">
    <div class="px-6 py-4 flex justify-between items-center">
        <!-- Title Section -->
        <div class="flex-1">
            <h2 class="text-xl font-bold text-white">@yield('header')</h2>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-6">
            <!-- Notification Bell -->
            <div class="relative">
                <button id="notificationBell" class="relative rounded-lg transition-colors group">
                    <!-- Bell SVG Icon -->
                    <svg class="w-6 h-6 text-gray-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>

                    <!-- Notification Badge -->
                    <span id="notificationBadge" class="absolute -top-1 -right-1 bg-gradient-to-r from-green-500 to-green-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">0</span>
                </button>

                <!-- Notification Dropdown -->
                <div id="notificationDropdown" class="absolute right-0 mt-2 w-96 bg-white shadow-2xl z-50 hidden max-h-96 overflow-y-auto dropdown-animate">
                    <div id="notificationList" class="divide-y divide-gray-200">
                        <!-- Notifications will be loaded here -->
                    </div>
                    <div class="p-3 border-t border-gray-200 text-center bg-gray-50">
                        <button onclick="markAllAsRead()" class="text-xs font-medium text-green-600 hover:text-green-700 transition-colors">Mark all as read</button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="h-6 w-px bg-gray-700"></div>

            <!-- User Profile Dropdown -->
            <div class="relative">
                <button id="profileBtn"
                    class="flex items-center gap-2 px-3 py-1 text-gray-300 hover:text-white rounded-lg">

                    @php $admin = adminInfo(); @endphp

                    <!-- Image -->
                    @if($admin && $admin->profile_pic)
                        <img src="{{ asset('storage/images/' . $admin->profile_pic) }}"
                            class="w-7 h-7 rounded-full object-cover" alt="profile picture">
                    @else
                        <div class="w-7 h-7 bg-gray-600 rounded-full"></div>
                    @endif

                    <!-- Name -->
                    <span class="text-md font-medium">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </span>

                    <!-- Dropdown Icon -->
                    <svg class="w-4 h-4 ml-1 text-gray-400 group-hover:text-white transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>

                </button>

                <!-- Profile Dropdown Menu -->
                <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white shadow-2xl z-50 hidden dropdown-animate overflow-hidden">
                    <a href="{{ route('admin.profile.change-password') }}" class="flex items-center gap-3 px-4 py-4 text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span class="text-sm font-medium">Change Password</span>
                    </a>
                    <div class="border-t border-gray-200"></div>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-4 text-gray-700 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm font-medium text-red-600">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown');
const notificationBell = document.getElementById('notificationBell');
const notificationDropdown = document.getElementById('notificationDropdown');
const notificationBadge = document.getElementById('notificationBadge');
const notificationList = document.getElementById('notificationList');

// Toggle profile dropdown
profileBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    profileDropdown.classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('#profileBtn') && !e.target.closest('#profileDropdown')) {
        profileDropdown.classList.add('hidden');
    }
});

// Toggle notification dropdown
notificationBell.addEventListener('click', function(e) {
    e.stopPropagation();
    notificationDropdown.classList.toggle('hidden');
    if (!notificationDropdown.classList.contains('hidden')) {
        loadNotifications();
    }
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('#notificationBell') && !e.target.closest('#notificationDropdown')) {
        notificationDropdown.classList.add('hidden');
    }
});

// Load notifications via AJAX
function loadNotifications() {
    fetch('{{ route("admin.notifications.list") }}')
        .then(response => response.json())
        .then(data => {
            updateNotificationUI(data);
        })
        .catch(error => console.error('Error loading notifications:', error));
}

// Update notification UI
function updateNotificationUI(data) {
    const unreadCount = data.filter(notif => !notif.is_read).length;

    // Update badge
    if (unreadCount > 0) {
        notificationBadge.textContent = unreadCount;
        notificationBadge.classList.remove('hidden');
    } else {
        notificationBadge.classList.add('hidden');
    }

    // Update list
    notificationList.innerHTML = '';
    if (data.length === 0) {
        notificationList.innerHTML = '<div class="p-4 text-center text-gray-500 text-sm">No notifications</div>';
    } else {
        data.forEach(notif => {
            const iconSVG = getNotificationIconSVG(notif.type);
            const notifHTML = `
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition border-l-4 ${!notif.is_read ? 'border-l-green-500 bg-green-50' : 'border-l-gray-300'}" onclick="readAndNavigateNotification(${notif.id}, '${notif.url || '#'}')">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            ${iconSVG}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">${notif.title}</p>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-2">${notif.message}</p>
                            <small class="text-xs text-gray-400 mt-2 block">${formatTime(notif.created_at)}</small>
                        </div>
                        ${!notif.is_read ? '<span class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-1"></span>' : ''}
                    </div>
                </div>
            `;
            notificationList.innerHTML += notifHTML;
        });
    }
}

// Get SVG icon based on notification type
function getNotificationIconSVG(type) {
    const icons = {
        'info': '<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'success': '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'warning': '<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-10a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'error': '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m8-2l2 2m0 0l2 2m-2-2l-2 2m2-2l2-2"></path></svg>',
        'message': '<svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>'
    };
    return icons[type] || '<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>';
}

// Get icon based on notification type (deprecated - use getNotificationIconSVG)
function getNotificationIcon(type) {
    const icons = {
        'info': 'info-circle',
        'success': 'check-circle',
        'warning': 'exclamation-triangle',
        'error': 'x-circle',
        'message': 'envelope'
    };
    return icons[type] || 'bell';
}

// Format time
function formatTime(datetime) {
    const date = new Date(datetime);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);

    if (diffInSeconds < 60) return 'just now';
    if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + 'm ago';
    if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + 'h ago';
    return Math.floor(diffInSeconds / 86400) + 'd ago';
}

// Mark notification as read and navigate
function readAndNavigateNotification(id, url) {
    fetch(`/admin/notifications/${id}/read`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(() => {
        loadNotifications();
        // Navigate to the notification URL if valid
        if (url && url !== '#') {
            window.location.href = url;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Mark all as read
function markAllAsRead() {
    fetch('{{ route("admin.notifications.mark-all-read") }}', {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(() => {
        loadNotifications();
    })
    .catch(error => console.error('Error:', error));
}

// Load notifications on page load
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();

    // Refresh notifications every 5 seconds
    setInterval(loadNotifications, 5000);
});
</script>

<style>
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-animate:not(.hidden) {
    animation: slideDown 0.3s ease-out;
}

#notificationBadge {
    font-size: 10px;
    font-weight: bold;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

#notificationDropdown {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
