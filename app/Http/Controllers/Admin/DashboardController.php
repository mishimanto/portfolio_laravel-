<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\Service;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Message statistics
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        // Portfolio statistics
        $totalPortfolios = Portfolio::count();
        $recentPortfolios = Portfolio::latest()->take(5)->get();

        // Other statistics
        $totalSkills = Skill::count();
        $totalServices = Service::count();
        $totalExperiences = Experience::count();
        $totalEducations = Education::count();

        return view('admin.dashboard', compact(
            'totalMessages',
            'unreadMessages',
            'recentMessages',
            'totalPortfolios',
            'recentPortfolios',
            'totalSkills',
            'totalServices',
            'totalExperiences',
            'totalEducations'
        ));
    }
}

