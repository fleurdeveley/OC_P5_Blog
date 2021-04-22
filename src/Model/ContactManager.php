<?php

namespace Blog\Model;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

/**
 * Class ContactManager
 */

class ContactManager extends Manager
{
    /**
     * @param Contact $contact
     * @return bool
     */
    public function save(Contact $contact): bool
    {
        $message = 'Nom : '.$contact->getLastname() . "\n" . 'Prénom : '.$contact->getFirstname(). "\n" .
            'Email : '.$contact->getEmail(). "\n" . 'Message : '.$contact->getMessage();

        $transport = (new Swift_SmtpTransport($_ENV['MAIL_SERVER'], $_ENV['MAIL_PORT']))
            ->setUsername($_ENV['MAIL_USERNAME'])
            ->setPassword($_ENV['MAIL_PASSWORD']);

        $mailer = new Swift_Mailer($transport);

        $swift_message = (new Swift_Message($_ENV['MAIL_OBJET']))
            ->setFrom([$_ENV['MAIL_FROM'] => $_ENV['MAIL_FROM_NAME']])
            ->setTo([$_ENV['MAIL_TO'] => $_ENV['MAIL_TO_NAME']])
            ->setBody($message);

        $result = $mailer->send($swift_message);

       return $result;
    }
}