<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();
        return view('admin.resume.index', compact('educations', 'experiences'));
    }

    // Education methods
    public function storeEducation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Education::create($request->all());

        return redirect()->route('admin.resume.index')->with('success', 'Education added successfully!');
    }

    public function updateEducation(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $education = Education::findOrFail($id);
        $education->update($request->all());

        return redirect()->route('admin.resume.index')->with('success', 'Education updated successfully!');
    }

    public function destroyEducation($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.resume.index')->with('success', 'Education deleted successfully!');
    }

    // Experience methods
    public function storeExperience(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Experience::create($request->all());

        return redirect()->route('admin.resume.index')->with('success', 'Experience added successfully!');
    }

    public function updateExperience(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $experience = Experience::findOrFail($id);
        $experience->update($request->all());

        return redirect()->route('admin.resume.index')->with('success', 'Experience updated successfully!');
    }

    public function destroyExperience($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.resume.index')->with('success', 'Experience deleted successfully!');
    }

    public function reorderEducation(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Education::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }

    public function reorderExperience(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Experience::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
