<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    public $fullname;
    public $module;
    public $password;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname, $module,$password)
    {
        $this->fullname=$fullname;
        $this->module=$module;
        $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from("noreply@m.tinkdea.com","SGR");
                     
        $this->subject('SGR - Bienvenido(a)');
        return $this->view('emails.welcome');

    }
}
