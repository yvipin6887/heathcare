<?php

namespace App\Vk\HealthCareBundle\EventListener;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * LoginListener constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // Get the User entity.
        $user = $event->getAuthenticationToken()->getUser();
        /** @var \Acme\UserBundle\Entity\User $user */
        $user->setLastLoggedAt(new DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
