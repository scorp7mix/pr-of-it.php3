<?php

namespace App\Commands;

use T4\Console\Command;
use T4\Mail\Sender;

class Notify
    extends Command
{
    public function actionGuests()
    {
        // Заглушка пока что
        $guestsToday = 7;

        $mailer = new Sender();

        if (false == $mailer->sendMail(
            ['scorp7mix@gmail.com', 'Maxim Fedorov'],
            'Оповещение о количестве посетителей',
            'Посетителей сегодня: ' . $guestsToday
        )) {
            echo 'Mail send failed! Error: ' . $mailer->ErrorInfo;
        } else {
            echo 'Mail successfully sended!';
        };
    }
}
