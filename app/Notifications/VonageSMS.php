<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Facades\Vonage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class VonageSMS extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(public string $loginCode)
  {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['vonage'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toVonage($notifiable)
  {
    return (new VonageMessage())
      ->content('Your Token is ' . $this->loginCode . " It expxires in 4 minutes.");
  }
}
