<?php

namespace Blog\Model;

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
        $message = 'Nom'.$contact->getLastname() . "\n" . 'Prénom'.$contact->getFirstname() . "\n" .
            'Email'.$contact->getEmail() . "\n" . 'Message'.$contact->getMessage();

       return mail('fleurdeveley@gmail.com', 'formulaire de contact', $message);
    }
}