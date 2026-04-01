@extends('layouts.admin')

@section('title', 'Skills Management')
@section('header', 'Skills Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-4">Add New Skill</h3>
    <form action="{{ route('admin.skills.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                <input type="text" name="skill_name" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Skill Level (%)</label>
                <input type="number" name="skill_level" min="0" max="100" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Skill</button>
            </div>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Skills List</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Order</th>
                    <th class="px-6 py-3 text-left">Skill Name</th>
                    <th class="px-6 py-3 text-left">Level</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($skills as $skill)
                <tr class="border-b cursor-move" data-id="{{ $skill->id }}">
                    <td class="px-6 py-4"><i class="bi bi-grip-vertical"></i></td>
                    <td class="px-6 py-4">{{ $skill->skill_name }}</td>
                    <td class="px-6 py-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 rounded-full h-2" style="width: {{ $skill->skill_level }}%"></div>
                        </div>
                        <span class="text-sm">{{ $skill->skill_level }}%</span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="editSkill({{ $skill->id }}, '{{ $skill->skill_name }}', {{ $skill->skill_level }})" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button onclick="deleteSkill({{ $skill->id }})" class="text-red-500 hover:text-red-700">
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
        <h3 class="text-lg font-semibold mb-4">Edit Skill</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Skill Name</label>
                <input type="text" id="edit_name" name="skill_name" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Skill Level (%)</label>
                <input type="number" id="edit_level" name="skill_level" min="0" max="100" class="w-full px-3 py-2 border rounded-lg" required>
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

            fetch('{{ route("admin.skills.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    function editSkill(id, name, level) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_level').value = level;
        document.getElementById('editForm').action = "{{ url('admin/skills') }}/" + id;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function deleteSkill(id) {
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
                form.action = `{{ url('admin/skills') }}/${id}`;
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
