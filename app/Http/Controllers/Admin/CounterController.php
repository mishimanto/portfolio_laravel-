<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::orderBy('order')->get();
        return view('admin.counters.index', compact('counters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'counter_title' => 'required|string|max:255',
            'counter_icon' => 'required|string|max:100',
            'pre_value' => 'required|integer|min:0',
            'post_value' => 'required|integer|min:0'
        ]);

        Counter::create($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Counter added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'counter_title' => 'required|string|max:255',
            'counter_icon' => 'required|string|max:100',
            'pre_value' => 'required|integer|min:0',
            'post_value' => 'required|integer|min:0'
        ]);

        $counter = Counter::findOrFail($id);
        $counter->update($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Counter updated successfully!');
    }

    public function destroy($id)
    {
        $counter = Counter::findOrFail($id);
        $counter->delete();

        return redirect()->route('admin.settings.index')->with('success', 'Counter deleted successfully!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Counter::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
