<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $email, $password, $mail)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendmail')->with([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'mail' => $this->mail
        ])->subject('Hi ' . $this->username . ' ! The account has been successfully updated.');
    }
}
