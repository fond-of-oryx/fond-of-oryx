<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FooAvailabilityAlertSubscriptionEntityTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscription;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Store\Persistence\SpyStore;

class AvailabilityAlertSubscriptionMapper implements AvailabilityAlertSubscriptionMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface
     */
    protected $subscriberMapper;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface $subscriberMapper
     */
    public function __construct(AvailabilityAlertSubscriberMapperInterface $subscriberMapper)
    {
        $this->subscriberMapper = $subscriberMapper;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function fromEntity(FooAvailabilityAlertSubscription $availabilityAlertSubscription): AvailabilityAlertSubscriptionTransfer
    {
        $transfer = new AvailabilityAlertSubscriptionTransfer();
        $transfer->fromArray($availabilityAlertSubscription->toArray(), true);

        return $transfer
            ->setSubscriber($this->subscriberMapper->fromEntity($availabilityAlertSubscription->getFooAvailabilityAlertSubscriber()))
            ->setLocale($this->mapLocale($availabilityAlertSubscription->getSpyLocale()))
            ->setProductAbstract($this->mapProductAbstract($availabilityAlertSubscription->getSpyProductAbstract()))
            ->setStore($this->mapStore($availabilityAlertSubscription->getSpyStore()))
            ->setFkSubscriber($availabilityAlertSubscription->getFkAvailabilityAlertSubscriber());
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\FooAvailabilityAlertSubscriptionEntityTransfer
     */
    public function fromTransfer(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): FooAvailabilityAlertSubscriptionEntityTransfer
    {
        $entity = new FooAvailabilityAlertSubscriptionEntityTransfer();
        $entity->fromArray($availabilityAlertSubscriptionTransfer->modifiedToArray(), true);
        $entity->setFkAvailabilityAlertSubscriber($availabilityAlertSubscriptionTransfer->getFkSubscriber());
        if ($availabilityAlertSubscriptionTransfer->getFkSubscriber() !== null) {
            $entity->setFkAvailabilityAlertSubscriber($availabilityAlertSubscriptionTransfer->getFkSubscriber());
        }

        if ($availabilityAlertSubscriptionTransfer->getFkSubscriber() === null && $availabilityAlertSubscriptionTransfer->getSubscriber() !== null) {
            $entity->setFkAvailabilityAlertSubscriber($availabilityAlertSubscriptionTransfer->getSubscriber()->getIdAvailabilityAlertSubscriber());
        }

        return $entity;
    }

    /**
     * @param \Orm\Zed\Store\Persistence\SpyStore $spyStore
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    protected function mapStore(SpyStore $spyStore): StoreTransfer
    {
        $storeTransfer = new StoreTransfer();
        $storeTransfer->fromArray($spyStore->toArray(), true);

        return $storeTransfer;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $spyProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected function mapProductAbstract(SpyProductAbstract $spyProductAbstract): ProductAbstractTransfer
    {
        $productAbstractTransfer = new ProductAbstractTransfer();
        $productAbstractTransfer->fromArray($spyProductAbstract->toArray(), true);

        return $productAbstractTransfer;
    }

    /**
     * @param \Orm\Zed\Locale\Persistence\SpyLocale $spyLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function mapLocale(SpyLocale $spyLocale): LocaleTransfer
    {
        $localeTransfer = new LocaleTransfer();
        $localeTransfer->fromArray($spyLocale->toArray(), true);

        return $localeTransfer;
    }
}
