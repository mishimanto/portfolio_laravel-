@extends('layouts.admin')

@section('title', 'Add Project')
@section('header', 'Add New Project')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Image</label>
                <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-1">Recommended size: 800x600px</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Date</label>
                <input type="text" name="project_date" class="w-full px-3 py-2 border rounded-lg" placeholder="2024">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                <input type="text" name="client" class="w-full px-3 py-2 border rounded-lg" placeholder="Client Name">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project URL</label>
                <input type="url" name="project_url" class="w-full px-3 py-2 border rounded-lg" placeholder="https://example.com">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="6" class="w-full px-3 py-2 border rounded-lg"></textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.portfolio.index') }}" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Project</button>
        </div>
    </form>
</div>
@endsection
