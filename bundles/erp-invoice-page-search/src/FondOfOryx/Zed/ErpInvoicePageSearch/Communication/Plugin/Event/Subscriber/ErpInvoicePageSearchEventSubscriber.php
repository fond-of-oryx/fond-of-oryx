<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Subscriber;

use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\Listener\ErpInvoicePageSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\ErpInvoicePageSearchCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Business\ErpInvoicePageSearchFacadeInterface getFacade()
 */
class ErpInvoicePageSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface|void
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addErpInvoicePublishListener($eventCollection);
        $this->addErpInvoiceUnPublishListener($eventCollection);
        $this->addErpInvoiceCreateListener($eventCollection);
        $this->addErpInvoiceUpdateListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addErpInvoiceCreateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_CREATE,
            new ErpInvoicePageSearchListener(),
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
    protected function addErpInvoiceUpdateListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(
            ErpInvoiceEvents::ENTITY_FOO_ERP_INVOICE_UPDATE,
            new ErpInvoicePageSearchListener(),
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
    protected function addErpInvoicePublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpInvoiceEvents::ERP_INVOICE_PUBLISH,
            new ErpInvoicePageSearchListener(),
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
    protected function addErpInvoiceUnPublishListener(
        EventCollectionInterface $eventCollection
    ): void {
        $eventCollection->addListenerQueued(
            ErpInvoiceEvents::ERP_INVOICE_UNPUBLISH,
            new ErpInvoicePageSearchListener(),
            0,
            null,
            $this->getConfig()->getEventQueueName(),
        );
    }
}
