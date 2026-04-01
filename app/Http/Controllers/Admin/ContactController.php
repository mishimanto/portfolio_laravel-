<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::first();
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.contact.index', compact('contactInfo', 'messages', 'unreadCount'));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255'
        ]);

        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = new ContactInfo();
        }

        $contactInfo->update($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Contact info updated successfully!');
    }

    public function destroyMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Message deleted successfully!');
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return redirect()->route('admin.contact.index')->with('success', 'Message marked as read!');
    }

    public function viewMessage($id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.contact.view', compact('message'));
    }

    
}
