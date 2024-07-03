<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioMmsMessage;

class SMSNotification extends Notification
{
  use Queueable;

  public function __construct(public string $loginCode)
  {
    //
  }
  public function via($notifiable)
  {
    return [TwilioChannel::class];
  }

  public function toTwilio($notifiable)
  {
    return (new TwilioMmsMessage())
      ->content("Your login code is {$this->loginCode}!");
  }
}
