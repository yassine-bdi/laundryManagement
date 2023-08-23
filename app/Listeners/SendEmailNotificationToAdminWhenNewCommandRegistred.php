<?php

namespace App\Listeners;

use App\Events\newCommand;
use App\Mail\CommandNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationToAdminWhenNewCommandRegistred
{
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
        Mail::to(Auth::user()->email)->send(new CommandNotification($event->command));
    }
}
