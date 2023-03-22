<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Subscriber;

use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\Listener\ErpDeliveryNotePageSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\ErpDeliveryNotePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface getFacade()
 */
class ErpDeliveryNotePageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addErpDeliveryNotePublishListener($eventCollection);
        $this->addErpDeliveryNoteUnPublishListener($eventCollection);
        $this->addErpDeliveryNoteCreateListener($eventCollection);
        $this->addErpDeliveryNoteUpdateListener($eventCollection);
        $this->addErpDeliveryNoteDeleteListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpDeliveryNoteCreateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_CREATE,
            new ErpDeliveryNotePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpDeliveryNoteUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_UPDATE,
            new ErpDeliveryNotePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpDeliveryNoteDeleteListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpDeliveryNoteEvents::ENTITY_FOO_ERP_DELIVERY_NOTE_DELETE,
            new ErpDeliveryNotePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpDeliveryNotePublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_PUBLISH,
            new ErpDeliveryNotePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpDeliveryNoteUnPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_UNPUBLISH,
            new ErpDeliveryNotePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }
}
