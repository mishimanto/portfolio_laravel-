@extends('layouts.admin')

@section('title', 'Portfolio Management')
@section('header', 'Portfolio Management')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Projects</h3>
        <a href="{{ route('admin.portfolio.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add New Project</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                    <th class="px-6 py-3 text-left">Image</th>
                    <th class="px-6 py-3 text-left">Title</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach($portfolios as $portfolio)
                <tr class="border-b cursor-move" data-id="{{ $portfolio->id }}">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/images/' . $portfolio->image) }}" class="w-12 h-12 object-cover rounded" alt="{{ $portfolio->title }}">
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ $portfolio->title }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-200 rounded-full text-sm">{{ $portfolio->category->name }}</span>
                    </td>
                    <td class="px-6 py-4">{{ $portfolio->project_date ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button onclick="deletePortfolio({{ $portfolio->id }})" class="text-red-500 hover:text-red-700">
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

            fetch('{{ route("admin.portfolio.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });

    function deletePortfolio(id) {
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
                form.action = `{{ url('admin/portfolio') }}/${id}`;
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
