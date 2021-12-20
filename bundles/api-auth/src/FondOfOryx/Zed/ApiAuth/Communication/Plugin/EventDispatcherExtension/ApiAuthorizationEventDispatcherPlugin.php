<?php

namespace FondOfOryx\Zed\ApiAuth\Communication\Plugin\EventDispatcherExtension;

use FondOfOryx\Shared\ApiAuth\ApiAuthConstants;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\EventDispatcher\EventDispatcherInterface;
use Spryker\Shared\EventDispatcherExtension\Dependency\Plugin\EventDispatcherPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @method \FondOfOryx\Zed\ApiAuth\ApiAuthConfig getConfig()
 * @method \FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacadeInterface getFacade()
 */
class ApiAuthorizationEventDispatcherPlugin extends AbstractPlugin implements EventDispatcherPluginInterface
{
    /**
     * @param \Spryker\Shared\EventDispatcher\EventDispatcherInterface $eventDispatcher
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Shared\EventDispatcher\EventDispatcherInterface
     */
    public function extend(
        EventDispatcherInterface $eventDispatcher,
        ContainerInterface $container
    ): EventDispatcherInterface {
        $eventDispatcher->addListener(KernelEvents::REQUEST, function (RequestEvent $event) {
            return $this->onKernelRequest($event);
        });

        return $eventDispatcher;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\RequestEvent $event
     *
     * @return \Symfony\Component\HttpKernel\Event\RequestEvent
     */
    protected function onKernelRequest(RequestEvent $event): RequestEvent
    {
        $request = $event->getRequest();

        $module = $request->attributes->get('module');
        $controller = $request->attributes->get('controller');

        if ($module !== 'api' || $controller !== 'rest') {
            return $event;
        }

        $token = $request->headers->get(ApiAuthConstants::HEADER_AUTHORIZATION, '');

        if ($this->getFacade()->isAuthenticated($token)) {
            return $event;
        }

        $event->setResponse(new Response('', 403));

        return $event;
    }
}
