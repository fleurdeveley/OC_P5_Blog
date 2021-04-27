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

        $transport = (new Swift_SmtpTransport(getenv('MAIL_SERVER'), getenv('MAIL_PORT')))
            ->setUsername(getenv('MAIL_USERNAME'))
            ->setPassword(getenv('MAIL_PASSWORD'));

        $mailer = new Swift_Mailer($transport);

        $swift_message = (new Swift_Message(getenv('MAIL_OBJET')))
            ->setFrom([getenv('MAIL_FROM') => getenv('MAIL_FROM_NAME')])
            ->setTo([getenv('MAIL_TO') => getenv('MAIL_TO_NAME')])
            ->setBody($message);

        $result = $mailer->send($swift_message);

       return $result;
    }
}