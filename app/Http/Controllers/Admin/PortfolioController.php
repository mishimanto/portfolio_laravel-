<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->orderBy('order')->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = basename($imagePath);
        }

        Portfolio::create($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio added successfully!');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = Category::all();
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255'
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete('images/' . $portfolio->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = basename($imagePath);
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->image) {
            Storage::disk('public')->delete('images/' . $portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio deleted successfully!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Portfolio::where('id', $id)->update(['order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
