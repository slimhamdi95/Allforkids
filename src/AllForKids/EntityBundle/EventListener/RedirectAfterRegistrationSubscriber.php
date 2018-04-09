<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 09/04/2018
 * Time: 21:02
 */

namespace AllForKids\EntityBundle\EventListener;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectAfterRegistrationSubscriber implements EventSubscriberInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('homepage');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }
    public static function getSubscribedEvents()
    {
        return [
            \FOS\UserBundle\FOSUserEvents::REGISTRATION_SUCCESS =>'onRegistrationSuccess'
        ];
    }

}