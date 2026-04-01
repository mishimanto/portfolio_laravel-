@extends('layouts.admin')

@section('title', 'Add Service')
@section('header', 'Add New Service')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Service Title</label>
            <input type="text" name="title" class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class</label>
            <input type="text" name="icon" class="w-full px-3 py-2 border rounded-lg" placeholder="bi bi-code-slash" required>
            <p class="text-xs text-gray-500 mt-1">Use Bootstrap Icons (bi bi-*) or any other icon library</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="text" rows="5" class="w-full px-3 py-2 border rounded-lg" required></textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.services.index') }}" class="mr-2 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Service</button>
        </div>
    </form>
</div>

<div class="mt-6 bg-gray-50 rounded-lg p-4">
    <h4 class="font-semibold mb-2">Common Bootstrap Icons:</h4>
    <div class="grid grid-cols-5 gap-2 text-sm">
        <code>bi-briefcase</code>
        <code>bi-code-slash</code>
        <code>bi-palette</code>
        <code>bi-bar-chart</code>
        <code>bi-binoculars</code>
        <code>bi-calendar</code>
        <code>bi-chat</code>
        <code>bi-cloud</code>
        <code>bi-cup</code>
        <code>bi-globe</code>
    </div>
</div>
@endsection
