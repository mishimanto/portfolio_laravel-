<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title', config('app.name', 'Portfolio'))</title>

    <!-- Favicon -->
    @php
        $settings = \App\Models\SiteSetting::first();
        $favicon = $settings && $settings->favicon ? asset('storage/images/' . $settings->favicon) : asset('favicon.ico');
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $favicon }}">
    <link rel="shortcut icon" href="{{ $favicon }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Loader/Spinner Styles */
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(194, 197, 207, 0.95);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader-wrapper.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .admin-spinner {
            width: 60px;
            height: 60px;
            position: relative;
            animation: spin 1s linear infinite;
        }

        .admin-spinner .circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3127bd;
            border-bottom-color: #2c328a;
        }

        .admin-spinner .circle:nth-child(2) {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-top-color: #6ee7b7;
            border-bottom-color: #a7f3d0;
            animation: spin 0.8s linear infinite reverse;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader-text {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.9rem;
            color: #a7f3d0;
            white-space: nowrap;
            letter-spacing: 1px;
            font-weight: 500;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <!-- Loader -->
    <div class="loader-wrapper" id="adminLoader">
        <div class="admin-spinner">
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
        <div class="loader-text">Loading...</div>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar Component -->
        @include('components.admin.sidebar')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header Component -->
            @include('components.admin.header')

            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer Component -->
    @include('components.admin.footer')

    <script>
        // Hide loader when page loads
        window.addEventListener('load', function() {
            const loader = document.getElementById('adminLoader');
            if (loader) {
                setTimeout(() => {
                    loader.classList.add('hidden');
                }, 300);
            }
        });
    </script>
</body>
</html>
