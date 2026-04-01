@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('header', 'Contact Messages')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-500 rounded-full">
                <i class="bi bi-envelope text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Messages</h3>
                <p class="text-2xl font-bold">{{ $messages->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-500 rounded-full">
                <i class="bi bi-envelope-open text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Unread Messages</h3>
                <p class="text-2xl font-bold">{{ $unreadCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-500 rounded-full">
                <i class="bi bi-reply-all text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Read Messages</h3>
                <p class="text-2xl font-bold">{{ $messages->total() - $unreadCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
    <form action="{{ route('admin.contact.info.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" name="address" value="{{ $contactInfo->address ?? '' }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="text" name="phone" value="{{ $contactInfo->phone ?? '' }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ $contactInfo->email ?? '' }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Contact Info</button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Messages</h3>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Subject</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr class="border-b {{ !$message->is_read ? 'bg-blue-50' : '' }}">
                    <td class="px-6 py-4">
                        @if(!$message->is_read)
                            <span class="px-2 py-1 bg-blue-500 text-white rounded-full text-xs">New</span>
                        @else
                            <span class="px-2 py-1 bg-gray-300 text-gray-600 rounded-full text-xs">Read</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ $message->name }}</td>
                    <td class="px-6 py-4">{{ $message->email }}</td>
                    <td class="px-6 py-4">{{ Str::limit($message->subject, 30) }}</td>
                    <td class="px-6 py-4">{{ $message->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.contact.message.view', $message->id) }}" class="text-green-500 hover:text-green-700 mr-2">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button onclick="markAsRead({{ $message->id }})" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-check-circle"></i>
                        </button>
                        <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>

<script>
    function markAsRead(id) {
        Swal.fire({
            title: 'Mark as read?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/contact/message') }}/${id}/read`;
                form.innerHTML = `
                    @csrf
                    @method('PATCH')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function deleteMessage(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This message will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/contact/message') }}/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection
