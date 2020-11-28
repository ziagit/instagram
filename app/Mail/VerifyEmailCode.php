<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailCode extends Mailable
{
    use Queueable, SerializesModels;

    protected $email,$username,$id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$username,$id)
    {
        $this->email = $email;
        $this->username = $username;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $username = $this->username;
        $id = $this->id;
        $url = config('app.url');
        return $this->subject("Verify Account")->view('auth.verifyview',compact("email",'username','id','url'));
    }
}
