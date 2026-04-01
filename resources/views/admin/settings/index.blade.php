@extends('layouts.admin')

@section('title', 'Site Settings')
@section('header', 'Site Settings')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- General Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">General Settings</h3>
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Site Title</label>
                <input type="text" name="site_title" value="{{ $settings->site_title ?? '' }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                <textarea name="site_description" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ $settings->site_description ?? '' }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
                @if($settings && $settings->background_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/images/' . $settings->background_image) }}" class="w-full h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="background_image" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Recommended size: 1920x1080px</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                @if($settings && $settings->favicon)
                    <div class="mb-2 flex items-center gap-2">
                        <img src="{{ asset('storage/images/' . $settings->favicon) }}" class="w-8 h-8 rounded">
                        <span class="text-sm text-gray-600">Current favicon</span>
                    </div>
                @endif
                <input type="file" name="favicon" class="w-full px-3 py-2 border rounded-lg" accept="image/x-icon,image/png,image/jpeg">
                <p class="text-xs text-gray-500 mt-1">Recommended formats: .ico, .png (32x32px). Upload new to replace.</p>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="show_social_icons" value="1" {{ ($settings && $settings->show_social_icons) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Show Social Icons</span>
                </label>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Settings</button>
        </form>
    </div>

    <!-- Social Media -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Social Media</h3>
            <button onclick="openSocialModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Social</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Order</th>
                        <th class="px-4 py-2 text-left">Icon</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Link</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="social-sortable">
                    @foreach($socialMedia as $social)
                    <tr class="border-b cursor-move" data-id="{{ $social->id }}">
                        <td class="px-4 py-2"><i class="bi bi-grip-vertical"></i></td>
                        <td class="px-4 py-2"><i class="bi bi-{{ $social->icon }} text-xl"></i></td>
                        <td class="px-4 py-2">{{ $social->name }}</td>
                        <td class="px-4 py-2"><a href="{{ $social->link }}" target="_blank" class="text-blue-500">{{ Str::limit($social->link, 30) }}</a></td>
                        <td class="px-4 py-2">
                            <button onclick="toggleStatus({{ $social->id }})" class="px-2 py-1 rounded text-xs {{ $social->is_active ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600' }}">
                                {{ $social->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-4 py-2">
                            <button onclick="editSocial({{ $social->id }}, '{{ $social->name }}', '{{ $social->icon }}', '{{ $social->link }}')" class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button onclick="deleteSocial({{ $social->id }})" class="text-red-500 hover:text-red-700">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Counters -->
    <div class="bg-white rounded-lg shadow p-6 col-span-1 lg:col-span-2">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Counters</h3>
            <button onclick="openCounterModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Counter</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Order</th>
                        <th class="px-4 py-2 text-left">Icon</th>
                        <th class="px-4 py-2 text-left">Title</th>
                        <th class="px-4 py-2 text-left">Pre Value</th>
                        <th class="px-4 py-2 text-left">Post Value</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="counter-sortable">
                    @foreach($counters as $counter)
                    <tr class="border-b cursor-move" data-id="{{ $counter->id }}">
                        <td class="px-4 py-2"><i class="bi bi-grip-vertical"></i></td>
                        <td class="px-4 py-2"><i class="{{ $counter->counter_icon }} text-xl"></i></td>
                        <td class="px-4 py-2">{{ $counter->counter_title }}</td>
                        <td class="px-4 py-2">{{ $counter->pre_value }}</td>
                        <td class="px-4 py-2">{{ $counter->post_value }}</td>
                        <td class="px-4 py-2">
                            <button onclick="editCounter({{ $counter->id }}, '{{ $counter->counter_title }}', '{{ $counter->counter_icon }}', {{ $counter->pre_value }}, {{ $counter->post_value }})" class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button onclick="deleteCounter({{ $counter->id }})" class="text-red-500 hover:text-red-700">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Social Media Modal -->
<div id="socialModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4" id="socialModalTitle">Add Social Media</h3>
        <form id="socialForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="socialMethod" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Platform Name</label>
                <input type="text" id="social_name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                <input type="text" id="social_icon" name="icon" class="w-full px-3 py-2 border rounded-lg" placeholder="twitter, facebook, instagram" required>
                <p class="text-xs text-gray-500 mt-1">Use icon name without 'bi bi-' prefix</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile URL</label>
                <input type="url" id="social_link" name="link" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeSocialModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Counter Modal -->
<div id="counterModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4" id="counterModalTitle">Add Counter</h3>
        <form id="counterForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="counterMethod" value="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Counter Title</label>
                <input type="text" id="counter_title" name="counter_title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
                <input type="text" id="counter_icon" name="counter_icon" class="w-full px-3 py-2 border rounded-lg" placeholder="bi bi-emoji-smile" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Value</label>
                    <input type="number" id="counter_pre" name="pre_value" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">End Value</label>
                    <input type="number" id="counter_post" name="post_value" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeCounterModal()" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Social media sorting
    new Sortable(document.getElementById('social-sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#social-sortable tr').forEach((row, index) => {
                order.push(row.dataset.id);
            });

            fetch('{{ route("admin.settings.social-media.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    // Counter sorting
    new Sortable(document.getElementById('counter-sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#counter-sortable tr').forEach((row, index) => {
                order.push(row.dataset.id);
            });

            fetch('{{ route("admin.settings.counters.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    let socialData = @json($socialMedia);
    let counterData = @json($counters);

    function openSocialModal() {
        document.getElementById('socialModalTitle').textContent = 'Add Social Media';
        document.getElementById('socialForm').action = '{{ route("admin.settings.social-media.store") }}';
        document.getElementById('socialMethod').value = 'POST';
        document.getElementById('social_name').value = '';
        document.getElementById('social_icon').value = '';
        document.getElementById('social_link').value = '';
        document.getElementById('socialModal').classList.remove('hidden');
        document.getElementById('socialModal').classList.add('flex');
    }

    function editSocial(id, name, icon, link) {
        document.getElementById('socialModalTitle').textContent = 'Edit Social Media';
        document.getElementById('socialForm').action = `{{ url('admin/settings/social-media') }}/${id}`;
        document.getElementById('socialMethod').value = 'PUT';
        document.getElementById('social_name').value = name;
        document.getElementById('social_icon').value = icon;
        document.getElementById('social_link').value = link;
        document.getElementById('socialModal').classList.remove('hidden');
        document.getElementById('socialModal').classList.add('flex');
    }

    function closeSocialModal() {
        document.getElementById('socialModal').classList.add('hidden');
        document.getElementById('socialModal').classList.remove('flex');
    }

    function deleteSocial(id) {
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
                form.action = `{{ url('admin/settings/social-media') }}/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function toggleStatus(id) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/settings/social-media') }}/${id}/toggle`;
        form.innerHTML = `
            @csrf
            @method('PATCH')
        `;
        document.body.appendChild(form);
        form.submit();
    }

    function openCounterModal() {
        document.getElementById('counterModalTitle').textContent = 'Add Counter';
        document.getElementById('counterForm').action = '{{ route("admin.settings.counters.store") }}';
        document.getElementById('counterMethod').value = 'POST';
        document.getElementById('counter_title').value = '';
        document.getElementById('counter_icon').value = '';
        document.getElementById('counter_pre').value = '';
        document.getElementById('counter_post').value = '';
        document.getElementById('counterModal').classList.remove('hidden');
        document.getElementById('counterModal').classList.add('flex');
    }

    function editCounter(id, title, icon, pre, post) {
        document.getElementById('counterModalTitle').textContent = 'Edit Counter';
        document.getElementById('counterForm').action = `{{ url('admin/settings/counters') }}/${id}`;
        document.getElementById('counterMethod').value = 'PUT';
        document.getElementById('counter_title').value = title;
        document.getElementById('counter_icon').value = icon;
        document.getElementById('counter_pre').value = pre;
        document.getElementById('counter_post').value = post;
        document.getElementById('counterModal').classList.remove('hidden');
        document.getElementById('counterModal').classList.add('flex');
    }

    function closeCounterModal() {
        document.getElementById('counterModal').classList.add('hidden');
        document.getElementById('counterModal').classList.remove('flex');
    }

    function deleteCounter(id) {
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
                form.action = `{{ url('admin/settings/counters') }}/${id}`;
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
