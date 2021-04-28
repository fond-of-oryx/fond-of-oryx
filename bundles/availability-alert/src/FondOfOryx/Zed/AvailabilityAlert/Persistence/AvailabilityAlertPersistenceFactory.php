<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapper;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapper;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapperInterface;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriberQuery;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface getRepository()
 */
class AvailabilityAlertPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery
     */
    public function createAvailabilityAlertSubscriptionQuery(): FooAvailabilityAlertSubscriptionQuery
    {
        return FooAvailabilityAlertSubscriptionQuery::create();
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriberQuery
     */
    public function createAvailabilityAlertSubscriberQuery(): FooAvailabilityAlertSubscriberQuery
    {
        return FooAvailabilityAlertSubscriberQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriberMapperInterface
     */
    public function createAvailabilityAlertSubscriberMapper(): AvailabilityAlertSubscriberMapperInterface
    {
        return new AvailabilityAlertSubscriberMapper();
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper\AvailabilityAlertSubscriptionMapperInterface
     */
    public function createAvailabilityAlertSubscriptionMapper(): AvailabilityAlertSubscriptionMapperInterface
    {
        return new AvailabilityAlertSubscriptionMapper($this->createAvailabilityAlertSubscriberMapper());
    }
}
