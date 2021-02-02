<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Subscriber;


use FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Listener\ErpOrderPageSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ErpOrderPageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface|void
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        return $eventCollection;
    }

}
