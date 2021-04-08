<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Subscriber;

use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\Listener\ErpOrderPageSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 */
class ErpOrderPageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface|void
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addErpOrderPublishListener($eventCollection);
        $this->addErpOrderUnPublishListener($eventCollection);
        $this->addErpOrderCreateListener($eventCollection);
        $this->addErpOrderUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpOrderCreateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_CREATE,
            new ErpOrderPageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpOrderUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpOrderEvents::ENTITY_FOO_ERP_ORDER_UPDATE,
            new ErpOrderPageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpOrderPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpOrderEvents::ERP_ORDER_PUBLISH,
            new ErpOrderPageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpOrderUnPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpOrderEvents::ERP_ORDER_UNPUBLISH,
            new ErpOrderPageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName()
        );
    }
}
