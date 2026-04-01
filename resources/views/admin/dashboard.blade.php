@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Messages Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-blue-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Messages</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMessages }}</h3>
            </div>
            <div class="p-4 bg-blue-100 rounded-full">
                <i class="bi bi-envelope text-blue-500 text-2xl"></i>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3">{{ $unreadMessages }} unread</p>
    </div>

    <!-- Unread Messages Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-yellow-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Unread Messages</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $unreadMessages }}</h3>
            </div>
            <div class="p-4 bg-yellow-100 rounded-full">
                <i class="bi bi-exclamation-circle text-yellow-500 text-2xl"></i>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3"><a href="{{ route('admin.contact.index') }}" class="text-blue-600 hover:underline">View all messages</a></p>
    </div>

    <!-- Portfolio Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-purple-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Portfolio Items</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPortfolios }}</h3>
            </div>
            <div class="p-4 bg-purple-100 rounded-full">
                <i class="bi bi-images text-purple-500 text-2xl"></i>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3"><a href="{{ route('admin.portfolio.index') }}" class="text-blue-600 hover:underline">Manage projects</a></p>
    </div>

    <!-- Skills Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-green-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Skills</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSkills }}</h3>
            </div>
            <div class="p-4 bg-green-100 rounded-full">
                <i class="bi bi-star text-green-500 text-2xl"></i>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3"><a href="{{ route('admin.skills.index') }}" class="text-blue-600 hover:underline">Update skills</a></p>
    </div>
</div>

<!-- Second Row Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Services Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-indigo-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Services</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalServices }}</h3>
            </div>
            <div class="p-4 bg-indigo-100 rounded-full">
                <i class="bi bi-briefcase text-indigo-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Experience Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-pink-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Work Experience</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalExperiences }}</h3>
            </div>
            <div class="p-4 bg-pink-100 rounded-full">
                <i class="bi bi-briefcase text-pink-500 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Education Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-l-cyan-500 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Education</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEducations }}</h3>
            </div>
            <div class="p-4 bg-cyan-100 rounded-full">
                <i class="bi bi-mortarboard text-cyan-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">🚀 Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            <a href="{{ route('admin.portfolio.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-plus-circle mr-1"></i> New Project
            </a>
            <a href="{{ route('admin.skills.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-star mr-1"></i> Skills
            </a>
            <a href="{{ route('admin.services.index') }}" class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-briefcase mr-1"></i> Services
            </a>
            <a href="{{ route('admin.resume.index') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-file-text mr-1"></i> Resume
            </a>
            <a href="{{ route('admin.contact.index') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-envelope mr-1"></i> Messages
            </a>
            <a href="{{ route('admin.settings.index') }}" class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-3 rounded-lg hover:shadow-lg transition text-sm text-center font-medium">
                <i class="bi bi-gear mr-1"></i> Settings
            </a>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
        <h3 class="text-lg font-bold mb-4">📊 Summary</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span>Total Content</span>
                <span class="font-bold">{{ $totalPortfolios + $totalSkills + $totalServices + $totalExperiences + $totalEducations }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pending Messages</span>
                <span class="font-bold">{{ $unreadMessages }}</span>
            </div>
            <div class="border-t border-green-400 pt-3 mt-3">
                <p class="text-xs opacity-90">Your portfolio is {{ round((($totalPortfolios + $totalSkills + $totalServices) / 30) * 100) }}% complete</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Messages Section -->
@if($recentMessages->count() > 0)
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-800">📨 Recent Messages</h3>
        <a href="{{ route('admin.contact.index') }}" class="text-sm text-blue-600 hover:underline">View all →</a>
    </div>
    <div class="space-y-3">
        @foreach($recentMessages as $message)
            <div class="flex items-start justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <p class="font-semibold text-gray-800">{{ $message->name }}</p>
                        @if(!$message->is_read)
                            <span class="inline-block w-2 h-2 bg-blue-500 rounded-full"></span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->message, 80) }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ $message->created_at->diffForHumans() }}</p>
                </div>
                <a href="{{ route('admin.contact.message.view', $message->id) }}" class="ml-4 text-blue-600 hover:text-blue-800">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Recent Portfolio Items -->
@if($recentPortfolios->count() > 0)
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-800">🎨 Recent Projects</h3>
        <a href="{{ route('admin.portfolio.index') }}" class="text-sm text-blue-600 hover:underline">View all →</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($recentPortfolios as $portfolio)
            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                @if($portfolio->image)
                    <img src="{{ asset('storage/images/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-300 flex items-center justify-center">
                        <i class="bi bi-image text-gray-400 text-3xl"></i>
                    </div>
                @endif
                <div class="p-4">
                    <h4 class="font-semibold text-gray-800">{{ Str::limit($portfolio->title, 25) }}</h4>
                    <p class="text-xs text-gray-500 mt-1">{{ $portfolio->created_at->format('M d, Y') }}</p>
                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="flex-1 text-center text-sm bg-blue-100 text-blue-600 py-2 rounded hover:bg-blue-200 transition">
                            Edit
                        </a>
                        <a href="{{ route('admin.portfolio.destroy', $portfolio->id) }}" onclick="return confirm('Delete?')" class="flex-1 text-center text-sm bg-red-100 text-red-600 py-2 rounded hover:bg-red-200 transition">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection
