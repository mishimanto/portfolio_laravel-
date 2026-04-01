<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $personalInfos = PersonalInfo::all();
        return view('admin.about.index', compact('about', 'personalInfos'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf|max:5120'
        ]);

        $about = About::first();

        if (!$about) {
            $about = new About();
        }

        if ($request->hasFile('profile_pic')) {
            if ($about->profile_pic) {
                Storage::disk('public')->delete('images/' . $about->profile_pic);
            }
            $imagePath = $request->file('profile_pic')->store('images', 'public');
            $about->profile_pic = basename($imagePath);
        }

        if ($request->hasFile('cv')) {
            if ($about->cv) {
                Storage::disk('public')->delete('documents/' . $about->cv);
            }
            $cvPath = $request->file('cv')->store('documents', 'public');
            $about->cv = basename($cvPath);
        }

        $about->title = $request->title;
        $about->subtitle = $request->subtitle;
        $about->description = $request->description;
        $about->save();

        return redirect()->route('admin.about.index')->with('success', 'About updated successfully!');
    }

    public function addPersonalInfo(Request $request)
    {
        $request->validate([
            'info_title' => 'required|string|max:255',
            'info_desc' => 'required|string|max:255'
        ]);

        PersonalInfo::create($request->all());

        return redirect()->route('admin.about.index')->with('success', 'Personal info added successfully!');
    }

    public function updatePersonalInfo(Request $request, $id)
    {
        $request->validate([
            'info_title' => 'required|string|max:255',
            'info_desc' => 'required|string|max:255'
        ]);

        $info = PersonalInfo::findOrFail($id);
        $info->update($request->all());

        return redirect()->route('admin.about.index')->with('success', 'Personal info updated successfully!');
    }

    public function deletePersonalInfo($id)
    {
        $info = PersonalInfo::findOrFail($id);
        $info->delete();

        return redirect()->route('admin.about.index')->with('success', 'Personal info deleted successfully!');
    }
}
