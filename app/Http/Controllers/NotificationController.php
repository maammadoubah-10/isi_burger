<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // ✅ Affiche la liste des notifications pour le client
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->get();
        return view('notifications.index', compact('notifications'));
    }

    // ✅ Renvoie les notifications non lues (utilisé pour afficher le badge rouge)
    public function unread()
    {
        $unreadNotifications = Auth::user()->unreadNotifications;
        return response()->json([
            'count' => $unreadNotifications->count(),
            'notifications' => $unreadNotifications->map(function ($notification) {
                return [
                    'message' => $notification->data['message'],
                    'url' => $notification->data['url'],
                    'id' => $notification->id
                ];
            }),
        ]);
    }
    

    
    // ✅ Marque toutes les notifications comme lues
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}
