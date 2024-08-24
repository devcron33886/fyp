<?php

namespace App\Notifications;

use App\Models\TaskSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTaskSubmissionNotification extends Notification
{
    use Queueable;

    private $taskSubmission;

    /**
     * Create a new notification instance.
     */
    public function __construct(TaskSubmission $taskSubmission)
    {
        $this->taskSubmission = $taskSubmission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from($this->taskSubmission->submitted_by->email)
            ->greeting('Dear'.$this->taskSubmission->task->supervisor->name.',')
            ->line($this->taskSubmission->submitted_by->name.' has submitted work on the task assigned to.')
            ->action('Notification Action', url('/admin/tasks/'.$this->taskSubmission->task->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
