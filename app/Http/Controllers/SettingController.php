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
            'whatsapp_number' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'resume_file' => 'nullable|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        $settings = Setting::firstOrNew();

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            if ($settings->site_logo && Storage::disk('public')->exists($settings->site_logo)) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            $settings->site_logo = $logoPath;
        }

        // Handle resume file upload
        if ($request->hasFile('resume_file')) {
            // Delete old resume if exists
            if ($settings->resume_file && Storage::disk('public')->exists($settings->resume_file)) {
                Storage::disk('public')->delete($settings->resume_file);
            }
            
            $resumePath = $request->file('resume_file')->store('resumes', 'public');
            $settings->resume_file = $resumePath;
        }

        // Remove resume file if requested
        if ($request->has('remove_resume') && $request->remove_resume == '1') {
            if ($settings->resume_file && Storage::disk('public')->exists($settings->resume_file)) {
                Storage::disk('public')->delete($settings->resume_file);
            }
            $settings->resume_file = null;
        }

        // Update other fields
        $settings->fill($request->only([
            'site_name',
            'contact_email',
            'about_summary',
            'phone',
            'whatsapp_number',
            'linkedin_url',
            'github_url',
            'dark_mode'
        ]));

        $settings->save();

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}