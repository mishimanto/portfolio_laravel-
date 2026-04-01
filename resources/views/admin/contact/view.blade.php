@extends('layouts.admin')

@section('title', 'View Message')
@section('header', 'View Message')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.contact.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="bi bi-arrow-left"></i> Back to Messages
        </a>
    </div>

    <div class="border-b pb-4 mb-4">
        <h3 class="text-2xl font-bold mb-2">{{ $message->subject }}</h3>
        <div class="flex gap-4 text-gray-600">
            <span><i class="bi bi-person"></i> {{ $message->name }}</span>
            <span><i class="bi bi-envelope"></i> {{ $message->email }}</span>
            <span><i class="bi bi-calendar"></i> {{ $message->created_at->format('F d, Y H:i') }}</span>
        </div>
    </div>

    <div class="prose max-w-none">
        <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
    </div>

    <div class="mt-6 pt-4 border-t flex justify-end gap-2">
        <button onclick="markAsRead({{ $message->id }})" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            <i class="bi bi-check-circle"></i> Mark as Read
        </button>
        <button onclick="deleteMessage({{ $message->id }})" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            <i class="bi bi-trash"></i> Delete
        </button>
    </div>
</div>

<script>
    function markAsRead(id) {
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
