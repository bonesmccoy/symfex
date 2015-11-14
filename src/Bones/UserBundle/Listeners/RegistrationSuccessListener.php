<?php

namespace Bones\UserBundle\Listeners;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Propel\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegistrationSuccessListener implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $form = $event->getForm();
        /** @var User $user */
        $user = $form->getData();
        $userType = $form->get('type')->getData();

        $user->addRole($userType);
        $user->save();
    }
}