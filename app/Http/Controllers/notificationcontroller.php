<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notificationcontroller extends Controller
{
    // buat controller bell

    public function markNotificationsAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back(); // Redirect kembali ke halaman sebelumnya.
    }

}
