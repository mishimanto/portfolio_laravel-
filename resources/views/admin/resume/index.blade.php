@extends('layouts.admin')

@section('title', 'Resume Management')
@section('header', 'Resume Management')

@section('content')
<!-- Education Section -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Education</h3>
        <button onclick="openEducationModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Education</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Location</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="education-sortable">
                @foreach($educations as $education)
                <tr class="border-b cursor-move" data-id="{{ $education->id }}">
                    <td class="px-6 py-4">{{ $education->title }}</td>
                    <td class="px-6 py-4">{{ $education->date }}</td>
                    <td class="px-6 py-4">{{ $education->location }}</td>
                    <td class="px-6 py-4">{{ Str::limit($education->description, 50) }}</td>
                    <td class="px-6 py-4">
                        <button onclick="editEducation({{ $education->id }})" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button onclick="deleteEducation({{ $education->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Experience Section -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Professional Experience</h3>
        <button onclick="openExperienceModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Experience</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Location</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="experience-sortable">
                @foreach($experiences as $experience)
                <tr class="border-b cursor-move" data-id="{{ $experience->id }}">
                    <td class="px-6 py-4">{{ $experience->title }}</td>
                    <td class="px-6 py-4">{{ $experience->date }}</td>
                    <td class="px-6 py-4">{{ $experience->location }}</td>
                    <td class="px-6 py-4">{{ Str::limit($experience->description, 50) }}</td>
                    <td class="px-6 py-4">
                        <button onclick="editExperience({{ $experience->id }})" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button onclick="deleteExperience({{ $experience->id }})" class="text-red-500 hover:text-red-700">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Education Modal -->
<div id="educationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-semibold mb-4" id="educationModalTitle">Add Education</h3>
        <form id="educationForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="educationMethod" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Title/Degree</label>
                <input type="text" name="title" id="education_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="text" name="date" id="education_date" class="w-full px-3 py-2 border rounded-lg" placeholder="2015 - 2019" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Location/Institution</label>
                <input type="text" name="location" id="education_location" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="education_description" rows="4" class="w-full px-3 py-2 border rounded-lg"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEducationModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Experience Modal -->
<div id="experienceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-semibold mb-4" id="experienceModalTitle">Add Experience</h3>
        <form id="experienceForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="experienceMethod" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                <input type="text" name="title" id="experience_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="text" name="date" id="experience_date" class="w-full px-3 py-2 border rounded-lg" placeholder="2020 - Present" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Company/Location</label>
                <input type="text" name="location" id="experience_location" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="experience_description" rows="4" class="w-full px-3 py-2 border rounded-lg"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeExperienceModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Education sorting
    new Sortable(document.getElementById('education-sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#education-sortable tr').forEach((row, index) => {
                order.push(row.dataset.id);
            });

            fetch('{{ route("admin.resume.education.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    // Experience sorting
    new Sortable(document.getElementById('experience-sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#experience-sortable tr').forEach((row, index) => {
                order.push(row.dataset.id);
            });

            fetch('{{ route("admin.resume.experience.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    let educationData = @json($educations);
    let experienceData = @json($experiences);

    function openEducationModal() {
        document.getElementById('educationModalTitle').textContent = 'Add Education';
        document.getElementById('educationForm').action = '{{ route("admin.resume.education.store") }}';
        document.getElementById('educationMethod').value = 'POST';
        document.getElementById('education_title').value = '';
        document.getElementById('education_date').value = '';
        document.getElementById('education_location').value = '';
        document.getElementById('education_description').value = '';
        document.getElementById('educationModal').classList.remove('hidden');
        document.getElementById('educationModal').classList.add('flex');
    }

    function editEducation(id) {
        let education = educationData.find(e => e.id == id);
        if (education) {
            document.getElementById('educationModalTitle').textContent = 'Edit Education';
            document.getElementById('educationForm').action = `{{ url('admin/resume/education') }}/${id}`;
            document.getElementById('educationMethod').value = 'PUT';
            document.getElementById('education_title').value = education.title;
            document.getElementById('education_date').value = education.date;
            document.getElementById('education_location').value = education.location;
            document.getElementById('education_description').value = education.description;
            document.getElementById('educationModal').classList.remove('hidden');
            document.getElementById('educationModal').classList.add('flex');
        }
    }

    function closeEducationModal() {
        document.getElementById('educationModal').classList.add('hidden');
        document.getElementById('educationModal').classList.remove('flex');
    }

    function deleteEducation(id) {
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
                form.action = `{{ url('admin/resume/education') }}/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function openExperienceModal() {
        document.getElementById('experienceModalTitle').textContent = 'Add Experience';
        document.getElementById('experienceForm').action = '{{ route("admin.resume.experience.store") }}';
        document.getElementById('experienceMethod').value = 'POST';
        document.getElementById('experience_title').value = '';
        document.getElementById('experience_date').value = '';
        document.getElementById('experience_location').value = '';
        document.getElementById('experience_description').value = '';
        document.getElementById('experienceModal').classList.remove('hidden');
        document.getElementById('experienceModal').classList.add('flex');
    }

    function editExperience(id) {
        let experience = experienceData.find(e => e.id == id);
        if (experience) {
            document.getElementById('experienceModalTitle').textContent = 'Edit Experience';
            document.getElementById('experienceForm').action = `{{ url('admin/resume/experience') }}/${id}`;
            document.getElementById('experienceMethod').value = 'PUT';
            document.getElementById('experience_title').value = experience.title;
            document.getElementById('experience_date').value = experience.date;
            document.getElementById('experience_location').value = experience.location;
            document.getElementById('experience_description').value = experience.description;
            document.getElementById('experienceModal').classList.remove('hidden');
            document.getElementById('experienceModal').classList.add('flex');
        }
    }

    function closeExperienceModal() {
        document.getElementById('experienceModal').classList.add('hidden');
        document.getElementById('experienceModal').classList.remove('flex');
    }

    function deleteExperience(id) {
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
                form.action = `{{ url('admin/resume/experience') }}/${id}`;
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
