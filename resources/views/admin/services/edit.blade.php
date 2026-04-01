@extends('layouts.admin')

@section('title', 'Edit Service')
@section('header', 'Edit Service')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Service Title</label>
            <input type="text" name="title" value="{{ $service->title }}" class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
            <input type="text" name="icon" value="{{ $service->icon }}" class="w-full px-3 py-2 border rounded-lg" required>
            <div class="mt-2">
                <i class="{{ $service->icon }} text-2xl"></i>
                <span class="text-sm text-gray-500 ml-2">Preview: <i class="{{ $service->icon }}"></i></span>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="text" rows="5" class="w-full px-3 py-2 border rounded-lg" required>{{ $service->text }}</textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.services.index') }}" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Service</button>
        </div>
    </form>
</div>
@endsection
