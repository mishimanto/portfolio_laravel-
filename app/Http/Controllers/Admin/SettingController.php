<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $socialMedia = SocialMedia::orderBy('order')->get();
        $counters = Counter::orderBy('order')->get();

        return view('admin.settings.index', compact('settings', 'socialMedia', 'counters'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,x-icon|max:512',
            'show_social_icons' => 'boolean'
        ]);

        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        if ($request->hasFile('background_image')) {
            if ($settings->background_image) {
                Storage::disk('public')->delete('images/' . $settings->background_image);
            }
            $imagePath = $request->file('background_image')->store('images', 'public');
            $settings->background_image = basename($imagePath);
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete('images/' . $settings->favicon);
            }
            $faviconPath = $request->file('favicon')->store('images', 'public');
            $settings->favicon = basename($faviconPath);
        }

        $settings->site_title = $request->site_title;
        $settings->site_description = $request->site_description;
        $settings->show_social_icons = $request->show_social_icons ?? false;
        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
