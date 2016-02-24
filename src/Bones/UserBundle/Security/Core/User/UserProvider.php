<?php


namespace Bones\UserBundle\Security\Core\User;


use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider extends BaseClass
{

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $user = $this->userManager->findUserByUsernameOrEmail($response->getEmail());
        //$user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));

        if (null === $user) {

            $user = $this->userManager->createUser();
            $this->linkUserToOAuthAccount($response, $user);

            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($response->getUsername());
            $user->setEmail($response->getEmail());
            $user->setPassword($username);
            $user->setEnabled(true);

            $this->userManager->updateUser($user);

            return $user;
        }

        //if user exists - go with the HWIOAuth way
        try {
            $user = parent::loadUserByOAuthUserResponse($response);
        } catch (AccountNotLinkedException $e) {
            $this->linkUserToOAuthAccount($response, $user);
            $this->userManager->updateUser($user);
        }

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        $user->$setter($response->getAccessToken());

        return $user;
    }

    /**
     * @param UserResponseInterface $response
     * @param $user
     */
    private function linkUserToOAuthAccount(UserResponseInterface $response, UserInterface $user)
    {
        $username = $response->getUsername();
        $service = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';
        // create new user here
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
    }


}
