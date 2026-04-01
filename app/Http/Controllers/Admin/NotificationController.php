<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function list()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->limit(10)->get();

        // Transform to include 'url' field for frontend
        $notifications = $notifications->map(function ($notif) {
            return [
                'id' => $notif->id,
                'title' => $notif->title,
                'message' => $notif->message,
                'type' => $notif->type,
                'icon' => $notif->icon,
                'url' => $notif->link,
                'is_read' => $notif->is_read,
                'created_at' => $notif->created_at,
            ];
        });

        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        $count = Notification::where('is_read', false)->count();
        return response()->json(['unread_count' => $count]);
    }
}
