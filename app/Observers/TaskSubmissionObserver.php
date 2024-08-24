<?php

namespace App\Observers;

use App\Models\TaskSubmission;
use App\Notifications\NewTaskSubmissionNotification;
use Illuminate\Support\Facades\Notification;

class TaskSubmissionObserver
{
    public function created(TaskSubmission $taskSubmission)
    {
        $user=$taskSubmission->task->supervisor;
        Notification::send($user,new NewTaskSubmissionNotification($taskSubmission));

    }
}
