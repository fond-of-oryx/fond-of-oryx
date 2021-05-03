<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapperInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriberQuery;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertPersistenceFactory getFactory()
 */
class AvailabilityAlertEntityManager extends AbstractEntityManager implements AvailabilityAlertEntityManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapperInterface
     */
    protected $subscriptionMapper;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface
     */
    protected $subscriberMapper;

    /**
     * @var \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery
     */
    protected $subscriptionQuery;

    /**
     * @var \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriberQuery
     */
    protected $subscriberQuery;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function createOrUpdateSubscription(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        $availabilityAlertSubscriptionTransfer->requireFkSubscriber();
        $availabilityAlertSubscriptionTransfer->requireFkLocale();
        $availabilityAlertSubscriptionTransfer->requireFkProductAbstract();
        $availabilityAlertSubscriptionTransfer->requireFkStore();

        $mappedEntity = $this->getSubscriptionMapper()->fromTransfer($availabilityAlertSubscriptionTransfer);

        $entity = $this->getSubscriptionQuery()
            ->filterByFkAvailabilityAlertSubscriber($mappedEntity->getFkAvailabilityAlertSubscriber())
            ->filterByFkProductAbstract($availabilityAlertSubscriptionTransfer->getFkProductAbstract())
            ->findOneOrCreate();

        $id = $entity->getIdAvailabilityAlertSubscription();
        $createdAt = $entity->getCreatedAt() !== null ?: $mappedEntity->getCreatedAt();

        $entity->fromArray($mappedEntity->toArray());
        $entity
            ->setIdAvailabilityAlertSubscription($id)
            ->setUpdatedAt(time())
            ->setCreatedAt($createdAt)
            ->save();

        return $this->getSubscriptionMapper()->fromEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function createOrUpdateSubscriber(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): AvailabilityAlertSubscriberTransfer
    {
        $availabilityAlertSubscriberTransfer->requireEmail();

        $mappedEntity = $this->getSubscriberMapper()->fromTransfer($availabilityAlertSubscriberTransfer);

        $entity = $this->getSubscriberQuery()
            ->filterByEmail($availabilityAlertSubscriberTransfer->getEmail())
            ->findOneOrCreate();

        $id = $entity->getIdAvailabilityAlertSubscriber();
        $createdAt = $entity->getCreatedAt();

        $entity->fromArray($mappedEntity->toArray());
        $entity
            ->setIdAvailabilityAlertSubscriber($id)
            ->setUpdatedAt(time())
            ->setCreatedAt($createdAt)
            ->save();

        return $this->getSubscriberMapper()->fromEntity($entity);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapperInterface
     */
    protected function getSubscriptionMapper(): AvailabilityAlertSubscriptionMapperInterface
    {
        if ($this->subscriptionMapper === null) {
            $this->subscriptionMapper = $this->getFactory()->createAvailabilityAlertSubscriptionMapper();
        }

        return $this->subscriptionMapper;
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface
     */
    protected function getSubscriberMapper(): AvailabilityAlertSubscriberMapperInterface
    {
        if ($this->subscriberMapper === null) {
            $this->subscriberMapper = $this->getFactory()->createAvailabilityAlertSubscriberMapper();
        }

        return $this->subscriberMapper;
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery
     */
    protected function getSubscriptionQuery(): FooAvailabilityAlertSubscriptionQuery
    {
        if ($this->subscriptionQuery === null) {
            $this->subscriptionQuery = $this->getFactory()->createAvailabilityAlertSubscriptionQuery();
        }

        return $this->subscriptionQuery;
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriberQuery
     */
    protected function getSubscriberQuery(): FooAvailabilityAlertSubscriberQuery
    {
        if ($this->subscriberQuery === null) {
            $this->subscriberQuery = $this->getFactory()->createAvailabilityAlertSubscriberQuery();
        }

        return $this->subscriberQuery;
    }
}
