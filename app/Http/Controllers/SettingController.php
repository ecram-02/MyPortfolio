<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'about_summary' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'resume_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $settings = Setting::firstOrNew();

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            if ($settings->site_logo && Storage::exists($settings->site_logo)) {
                Storage::delete($settings->site_logo);
            }
            
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            $settings->site_logo = $logoPath;
        }

        // Update other fields
        $settings->fill($request->only([
            'site_name',
            'contact_email',
            'about_summary',
            'phone',
            'resume_url',
            'linkedin_url',
            'github_url',
            'twitter_url'
        ]));

        $settings->save();

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}