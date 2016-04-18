<?php

namespace App\Components;

use T4\Mail\Sender;

class MailProcessor
    extends Sender
{

    protected function validateEmail($email)
    {
        return false !== filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
}