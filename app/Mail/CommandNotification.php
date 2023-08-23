<?php

namespace App\Mail;

use App\Models\Command;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandNotification extends Mailable
{
    use Queueable, SerializesModels;
    

    public $command; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Command $command)
    {
        $this->command = $command; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.notification');
        
    }
}
