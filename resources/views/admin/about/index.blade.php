@extends('layouts.admin')

@section('title', 'About Management')
@section('header', 'About Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-4">Edit About Section</h3>
    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                @if($about && $about->profile_pic)
                    <div class="mb-2">
                        <img src="{{ asset('storage/images/' . $about->profile_pic) }}" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="profile_pic" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ $about->title ?? '' }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" value="{{ $about->subtitle ?? '' }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="5" class="w-full px-3 py-2 border rounded-lg">{{ $about->description ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CV (PDF)</label>
                @if($about && $about->cv)
                    <div class="mb-2">
                        <a href="{{ asset('storage/documents/' . $about->cv) }}" target="_blank" class="text-blue-500 hover:text-blue-700 flex items-center">
                            <i class="bi bi-file-pdf mr-2"></i>
                            Download Current CV
                        </a>
                    </div>
                @endif
                <input type="file" name="cv" accept=".pdf" class="w-full px-3 py-2 border rounded-lg">
                <p class="text-xs text-gray-500 mt-2">Only PDF files allowed</p>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update About</button>
    </form>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Personal Information</h3>
        <button onclick="openAddModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add New</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personalInfos as $info)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $info->info_title }}</td>
                    <td class="px-6 py-4">{{ $info->info_desc }}</td>
                    <td class="px-6 py-4">
                        <button onclick="editInfo({{ $info->id }}, '{{ $info->info_title }}', '{{ $info->info_desc }}')" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button onclick="deleteInfo({{ $info->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Add Personal Info</h3>
        <form action="{{ route('admin.about.personal-info.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="info_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <input type="text" name="info_desc" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Edit Personal Info</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="edit_title" name="info_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <input type="text" id="edit_desc" name="info_desc" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function editInfo(id, title, desc) {
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_desc').value = desc;
    document.getElementById('editForm').action = "{{ url('admin/about/personal-info') }}/" + id;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function deleteInfo(id) {
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
            form.action = `{{ url('admin/about/personal-info') }}/${id}`;
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
