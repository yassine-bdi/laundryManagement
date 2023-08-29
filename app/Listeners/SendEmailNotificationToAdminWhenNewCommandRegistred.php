<?php

namespace App\Listeners;

use App\Events\newCommand;
use App\Mail\CommandNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationToAdminWhenNewCommandRegistred implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 10;





    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\newCommand  $event
     * @return void
     */
    public function handle(newCommand $event)
    {
        $user = User::find(1);
        Mail::to($user->email)->send(new CommandNotification($event->command));
    }
}
