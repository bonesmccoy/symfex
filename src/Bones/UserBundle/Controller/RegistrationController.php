<?php


namespace Bones\UserBundle\Controller;

use Bones\UserBundle\Form\Registration\BuyerRegistrationType;
use Bones\UserBundle\Form\Registration\SellerRegistrationType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->buildForm($request);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Registration:register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    private function buildForm(Request $request)
    {
        $bonesUserConfig = $this->container->getParameter('bones_user');

        if (isset($bonesUserConfig['form_types'])) {
            foreach($bonesUserConfig['form_types'] as $formName => $className ) {
                if ( class_exists($className) ) {
                    if ($request->request->has($className::NAME)) {
                        return $this->createForm(new $className());
                    }
                }
            }
        }

        throw new \Exception("INVALID USER TYPE");
    }
}
