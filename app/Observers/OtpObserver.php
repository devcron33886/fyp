<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Support\Facades\Notification;

class OtpObserver
{
    public function updated(User $user)
    {
        Notification::send($user, new OtpNotification($user));
    }
}
