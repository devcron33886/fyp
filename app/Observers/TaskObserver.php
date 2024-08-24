<?php

namespace App\Observers;

use App\Models\Task;
use App\Notifications\NewTaskNotification;
use Illuminate\Support\Facades\Notification;

class TaskObserver
{
    public function created(Task $task)
    {
        // Assuming `assigned_to` is a relation that returns a User model
        $user = $task->assigned_to;

        // Send a notification to the assigned user
        Notification::send($user, new NewTaskNotification($task));
    }
}
