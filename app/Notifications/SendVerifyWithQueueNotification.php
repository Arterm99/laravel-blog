<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

// 29 урок. Убираем все и добавляем Имплементацию и Наследуем VerifyEmail. В .env QUEUE_CONNECTION перезаписать на database
class SendVerifyWithQueueNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

}
