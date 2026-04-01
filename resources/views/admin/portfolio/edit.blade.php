@extends('layouts.admin')

@section('title', 'Edit Project')
@section('header', 'Edit Project')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                <input type="text" name="title" value="{{ $portfolio->title }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $portfolio->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img src="{{ asset('storage/images/' . $portfolio->image) }}" class="w-32 h-32 object-cover rounded mb-2">
                <input type="file" name="image" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project Date</label>
                <input type="text" name="project_date" value="{{ $portfolio->project_date }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                <input type="text" name="client" value="{{ $portfolio->client }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Project URL</label>
                <input type="url" name="project_url" value="{{ $portfolio->project_url }}" class="w-full px-3 py-2 border rounded-lg">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="6" class="w-full px-3 py-2 border rounded-lg">{{ $portfolio->description }}</textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.portfolio.index') }}" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Project</button>
        </div>
    </form>
</div>
@endsection
