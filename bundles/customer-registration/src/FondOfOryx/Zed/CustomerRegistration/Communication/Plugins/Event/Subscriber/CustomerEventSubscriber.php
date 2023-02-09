<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Subscriber;

use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Listener\CustomerRegisteredUpdateListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CustomerEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addCustomerUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addCustomerUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListener(
            CustomerRegistrationConstants::ENTITY_CUSTOMER_UPDATE,
            new CustomerRegisteredUpdateListener(),
        );
    }
}
