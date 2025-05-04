<?php

namespace App\Http\Controllers\V1\api\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    use ResponseTrait;

    public function unreadNotifications()
    {
        $notifications = Auth::user()->unreadNotifications;
        return $this->success(NotificationResource::collection($notifications),__('successes.notifies.unread'));
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(string $id)
    {
        $user = Auth::user();
    
        // Bildirishnomani topish
        $notification = $user->notifications()->where('id', $id)->first();
        $notification->markAsRead();    
        // O'qilgan deb belgilash
        $notification->markAsRead();    
        return $this->success([],__('successes.notifies.read'));
    }
    
    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->each->markAsRead();
        return $this->success([],__('successes.notifies.allread'));
    }

    /**
     * Get all notifications.
     */
    public function allNotifications()
    {
        $notifications = Auth::user()->notifications;
        return $this->success(NotificationResource::collection($notifications),__('successes.notifies.all'));
    }
}
