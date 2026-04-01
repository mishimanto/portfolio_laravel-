<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        $interests = Interest::orderBy('order')->get();
        return view('admin.interests.index', compact('interests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'interest_title' => 'required|string|max:255',
            'interest_icon' => 'required|string|max:100',
            'color' => 'nullable|string|max:7'
        ]);

        Interest::create($request->all());

        return redirect()->route('admin.interests.index')->with('success', 'Interest added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'interest_title' => 'required|string|max:255',
            'interest_icon' => 'required|string|max:100',
            'color' => 'nullable|string|max:7'
        ]);

        $interest = Interest::findOrFail($id);
        $interest->update($request->all());

        return redirect()->route('admin.interests.index')->with('success', 'Interest updated successfully!');
    }

    public function destroy($id)
    {
        $interest = Interest::findOrFail($id);
        $interest->delete();

        return redirect()->route('admin.interests.index')->with('success', 'Interest deleted successfully!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Interest::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
