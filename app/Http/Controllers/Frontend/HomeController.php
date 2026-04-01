<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\About;
use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use App\Models\Counter;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Notification as AdminNotification;
use App\Models\PersonalInfo;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SocialMedia;
use App\Models\User;
use App\Notifications\NewContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;


class HomeController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();
        $about = About::first();
        $personalInfos = PersonalInfo::all();
        $skills = Skill::orderBy('order')->get();
        $interests = Interest::orderBy('order')->get();
        $educations = Education::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();
        $services = Service::orderBy('order')->get();
        $categories = Category::with('portfolios')->get();
        $portfolios = Portfolio::with('category')->orderBy('order')->get();
        $counters = Counter::orderBy('order')->get();
        $contactInfo = ContactInfo::first();
        $socialMedia = SocialMedia::where('is_active', true)->orderBy('order')->get();

        return view('frontend.home', compact(
            'siteSetting', 'about', 'personalInfos', 'skills', 'interests',
            'educations', 'experiences', 'services', 'categories', 'portfolios',
            'counters', 'contactInfo', 'socialMedia'
        ));
    }

    public function portfolioDetails($id)
    {
        $portfolio = Portfolio::with('category')->findOrFail($id);
        $siteSetting = SiteSetting::first();

        return view('frontend.portfolio-details', compact('portfolio', 'siteSetting'));
    }

    public function sendMessage(ContactRequest $request)
    {
        // Create the contact message
        $message = ContactMessage::create($request->validated());

        // Create admin notification
        try {
            AdminNotification::create([
                'title' => 'New Contact Message',
                'message' => 'New message from ' . $message->name . ': ' . substr($message->message, 0, 50) . '...',
                'type' => 'message',
                'icon' => 'envelope',
                'link' => route('admin.contact.index'),
                'is_read' => false
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create notification: ' . $e->getMessage());
        }

        // Send notification to admin (optional - requires mail setup)
        try {
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                Notification::send($admin, new NewContactMessage($message));
            }
        } catch (\Exception $e) {
            // Log error but don't break the flow
            Log::error('Failed to send notification: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
