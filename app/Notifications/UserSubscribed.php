<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Workspace;
use App\Models\SubscriptionPlan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserSubscribed extends Notification
{
    use Queueable;
    public $workspace;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Workspace $workspace)
    {
        $this->workspace = $workspace;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = User::find($this->workspace->owner_id);
        $sub_plan = SubscriptionPlan::find($this->workspace->plan_id);
        return (new MailMessage)
                    ->subject('New Subscription') 
                    ->greeting('Hello Admin,')
                    ->line('A user has subscribed to a plan. Here are the details:')
                    ->line('Name: ' . $user->first_name . ' ' . $user->last_name)
                    ->line('Email: ' . $user->email)
                    ->line('Workspace Name: ' . $this->workspace->name)
                    ->line('Subscription Plan: ' . $sub_plan->name)
                    ->line('Subscription Price: ' . $this->workspace->price)
                    ->line('Subscription Terms: ' . $this->workspace->term);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
