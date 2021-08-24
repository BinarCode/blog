<?php

namespace App\Mail\Restify\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public string $url)
    {
    }

    public function build()
    {
        return $this->markdown('reset-password');
    }
}
