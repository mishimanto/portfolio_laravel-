@extends('layouts.admin')

@section('title', 'Interests Management')
@section('header', 'Interests Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-4">Add New Interest</h3>
    <form action="{{ route('admin.interests.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Interest Title</label>
                <input type="text" name="interest_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                <input type="text" name="interest_icon" class="w-full px-3 py-2 border rounded-lg" placeholder="bi bi-heart" required>
                <p class="text-xs text-gray-500 mt-1">Use Bootstrap Icons (bi bi-*)</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Color (Hex)</label>
                <input type="color" name="color" class="w-full px-3 py-2 border rounded-lg" value="#18d26e">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Interest</button>
            </div>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Interests List</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                    <th class="px-6 py-3 text-left">Order</th>
                    <th class="px-6 py-3 text-left">Icon</th>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Color</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($interests as $interest)
                <tr class="border-b cursor-move" data-id="{{ $interest->id }}">
                    <td class="px-6 py-4"><i class="bi bi-grip-vertical"></i></td>
                    <td class="px-6 py-4"><i class="{{ $interest->interest_icon }}" style="color: #{{ $interest->color }}"></i></td>
                    <td class="px-6 py-4">{{ $interest->interest_title }}</td>
                    <td class="px-6 py-4"><div class="w-6 h-6 rounded" style="background: #{{ $interest->color }}"></div></td>
                    <td class="px-6 py-4">
                        <button onclick="editInterest({{ $interest->id }}, '{{ $interest->interest_title }}', '{{ $interest->interest_icon }}', '{{ $interest->color }}')" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button onclick="deleteInterest({{ $interest->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Edit Interest</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Interest Title</label>
                <input type="text" id="edit_title" name="interest_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                <input type="text" id="edit_icon" name="interest_icon" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Color (Hex)</label>
                <input type="color" id="edit_color" name="color" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
            </div>
        </form>
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

            fetch('{{ route("admin.interests.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    function editInterest(id, title, icon, color) {
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_icon').value = icon;
        document.getElementById('edit_color').value = '#' + color;
        document.getElementById('editForm').action = "{{ url('admin/interests') }}/" + id;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function deleteInterest(id) {
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
                form.action = `{{ url('admin/interests') }}/${id}`;
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
