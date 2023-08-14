<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecoverPassword extends Mailable
{
    public $fullName;
    public $newPassword;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullName,$newPassword)
    {
        $this->fullName=$fullName;
        $this->newPassword=$newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from("noreply@m.tinkdea.com","SGR");
                     
        $this->subject('SGR - Cambio de contraseña');
        return $this->view('emails.recoverpassword');

    }
}
