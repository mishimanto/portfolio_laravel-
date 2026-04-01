<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('order')->get();
        return view('admin.social-media.index', compact('socialMedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:social_media',
            'icon' => 'required|string|max:50',
            'link' => 'required|url|max:255'
        ]);

        SocialMedia::create($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Social media added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:social_media,name,' . $id,
            'icon' => 'required|string|max:50',
            'link' => 'required|url|max:255'
        ]);

        $social = SocialMedia::findOrFail($id);
        $social->update($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Social media updated successfully!');
    }

    public function destroy($id)
    {
        $social = SocialMedia::findOrFail($id);
        $social->delete();

        return redirect()->route('admin.settings.index')->with('success', 'Social media deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $social = SocialMedia::findOrFail($id);
        $social->update(['is_active' => !$social->is_active]);

        return redirect()->route('admin.settings.index')->with('success', 'Social media status updated!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            SocialMedia::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
