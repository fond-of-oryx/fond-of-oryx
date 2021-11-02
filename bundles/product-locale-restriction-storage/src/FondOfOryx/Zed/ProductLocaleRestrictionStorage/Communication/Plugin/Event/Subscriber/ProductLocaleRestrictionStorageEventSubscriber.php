<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Subscriber;

use FondOfOryx\Zed\ProductLocaleRestriction\Dependency\ProductLocaleRestrictionEvents;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractListener;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\Plugin\Event\Listener\ProductAbstractLocaleRestrictionListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\ProductEvents;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication\ProductLocaleRestrictionStorageCommunicationFactory getFactory()
 */
class ProductLocaleRestrictionStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection = $this->addProductAbstractListener($eventCollection);
        $eventCollection = $this->addProductAbstractLocaleRestrictionListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    protected function addProductAbstractListener(
        EventCollectionInterface $eventCollection
    ): EventCollectionInterface {
        $eventCollection->addListenerQueued(
            ProductEvents::PRODUCT_ABSTRACT_PUBLISH,
            new ProductAbstractListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        $eventCollection->addListenerQueued(
            ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_CREATE,
            new ProductAbstractListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        $eventCollection->addListenerQueued(
            ProductEvents::ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE,
            new ProductAbstractListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    protected function addProductAbstractLocaleRestrictionListener(
        EventCollectionInterface $eventCollection
    ): EventCollectionInterface {
        $eventCollection->addListenerQueued(
            ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_CREATE,
            new ProductAbstractLocaleRestrictionListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        $eventCollection->addListenerQueued(
            ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_UPDATE,
            new ProductAbstractLocaleRestrictionListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        $eventCollection->addListenerQueued(
            ProductLocaleRestrictionEvents::ENTITY_FOO_PRODUCT_ABSTRACT_LOCALE_RESTRICTION_DELETE,
            new ProductAbstractLocaleRestrictionListener(),
            0,
            null,
            $this->getConfig()->getProductAbstractLocaleRestrictionEventQueueName(),
        );

        return $eventCollection;
    }
}
