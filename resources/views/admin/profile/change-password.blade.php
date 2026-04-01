@extends('layouts.admin')

@section('title', 'Change Password')
@section('header', 'Change Password')

@section('content')
<div class="mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Update Your Password</h3>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-3">Current Password</label>
                <input id="current_password" name="current_password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition" autocomplete="current-password" placeholder="Enter your current password" />
                @error('current_password', 'updatePassword')
                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-3">New Password</label>
                <input id="password" name="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition" autocomplete="new-password" placeholder="Enter a new password" />
                <p class="mt-2 text-xs text-gray-500">Minimum 8 characters with uppercase, lowercase, numbers and special characters.</p>
                @error('password', 'updatePassword')
                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-3">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition" autocomplete="new-password" placeholder="Confirm your new password" />
                @error('password_confirmation', 'updatePassword')
                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <!-- Submit Button and Success Message -->
            <div class="flex items-center justify-between pt-4">
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gradient-to-r from-green-600 to-green-500 text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all font-semibold">Update Password</button>

                    @if (session('status') === 'password-updated')
                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                            <p id="successMessage" class="text-sm text-green-700 font-medium">✓ Your password has been updated successfully!</p>
                        </div>
                    @endif
                </div>

                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 hover:underline transition-colors">Back to Dashboard</a>
            </div>
        </form>
    </div>

    <!-- Security Tips -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h4 class="text-lg font-semibold text-blue-900 mb-4">🔒 Password Security Tips</h4>
        <ul class="space-y-2 text-blue-800 text-sm">
            <li class="flex items-start gap-2">
                <span class="text-blue-600 font-bold mt-0.5">•</span>
                <span>Use at least 8 characters combining uppercase, lowercase, numbers, and special characters</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-blue-600 font-bold mt-0.5">•</span>
                <span>Avoid using personal information like names, birthdates, or usernames</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-blue-600 font-bold mt-0.5">•</span>
                <span>Change your password regularly (at least every 3 months)</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-blue-600 font-bold mt-0.5">•</span>
                <span>Never share your password with anyone else</span>
            </li>
        </ul>
    </div>
</div>

<script>
    // Auto-hide success message after 4 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(function() {
                successMessage.parentElement.style.display = 'none';
            }, 4000);
        }
    });
</script>
@endsection
