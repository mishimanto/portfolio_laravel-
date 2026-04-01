@extends('layouts.admin')

@section('title', 'Services Management')
@section('header', 'Services Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Services</h3>
        <a href="{{ route('admin.services.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add New Service</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Order</th>
                    <th class="px-6 py-3 text-left">Icon</th>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($services as $service)
                <tr class="border-b cursor-move" data-id="{{ $service->id }}">
                    <td class="px-6 py-4"><i class="bi bi-grip-vertical"></i></td>
                    <td class="px-6 py-4"><i class="{{ $service->icon }} text-2xl"></i></td>
                    <td class="px-6 py-4 font-semibold">{{ $service->title }}</td>
                    <td class="px-6 py-4">{{ Str::limit($service->text, 100) }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button onclick="deleteService({{ $service->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    const sortable = new Sortable(document.getElementById('sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#sortable tr').forEach((row, index) => {
                order.push(row.dataset.id);
            });

            fetch('{{ route("admin.services.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    function deleteService(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/services') }}/${id}`;
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
