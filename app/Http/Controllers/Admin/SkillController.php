<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|integer|min:0|max:100'
        ]);

        Skill::create($request->all());

        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|integer|min:0|max:100'
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($request->all());

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Skill::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
