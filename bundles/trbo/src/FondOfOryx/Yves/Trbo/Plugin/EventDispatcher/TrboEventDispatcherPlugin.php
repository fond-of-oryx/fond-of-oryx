<?php

namespace FondOfOryx\Yves\Trbo\Plugin\EventDispatcher;

use FondOfOryx\Shared\Trbo\TrboConstants;
use Generated\Shared\Transfer\TrboTransfer;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\EventDispatcher\EventDispatcherInterface;
use Spryker\Shared\EventDispatcherExtension\Dependency\Plugin\EventDispatcherPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TrboEventDispatcherPlugin extends AbstractPlugin implements EventDispatcherPluginInterface
{
    /**
     * One year in seconds
     *
     * @var int
     */
    protected const COOKIE_EXPIRE = 31556926;

    /**
     * @param \Spryker\Shared\EventDispatcher\EventDispatcherInterface $eventDispatcher
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Shared\EventDispatcher\EventDispatcherInterface
     */
    public function extend(EventDispatcherInterface $eventDispatcher, ContainerInterface $container): EventDispatcherInterface
    {
        $transfer = new TrboTransfer();

        $eventDispatcher->addListener(KernelEvents::REQUEST, function (RequestEvent $event) use ($transfer) {
            $userId = $event->getRequest()->cookies->get(TrboConstants::TRBO_COOKIE_USERID);

            if ($userId === null) {
                $trboUserId = md5(uniqid('trbo'));
                $transfer->setUserId($trboUserId)
                    ->setGenerateUserId(true);
                $event->getRequest()->cookies->set(TrboConstants::TRBO_COOKIE_USERID, $trboUserId);
            }
        });

        $eventDispatcher->addListener(KernelEvents::RESPONSE, function (ResponseEvent $event) use ($transfer) {
            if ($transfer->getGenerateUserId() === true) {
                $event->getResponse()->headers->setCookie(
                    Cookie::create(TrboConstants::TRBO_COOKIE_USERID, $transfer->getUserId(), time() + static::COOKIE_EXPIRE),
                );
            }
        });

        return $eventDispatcher;
    }
}
