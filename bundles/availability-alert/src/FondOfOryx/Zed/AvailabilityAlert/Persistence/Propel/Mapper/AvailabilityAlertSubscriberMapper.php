<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriber;

class AvailabilityAlertSubscriberMapper implements AvailabilityAlertSubscriberMapperInterface
{
    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriber $availabilityAlertSubscriber
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function fromEntity(FooAvailabilityAlertSubscriber $availabilityAlertSubscriber): AvailabilityAlertSubscriberTransfer
    {
        return (new AvailabilityAlertSubscriberTransfer())->fromArray($availabilityAlertSubscriber->toArray(), true)->setIdAvailabilityAlertSubscriber($availabilityAlertSubscriber->getIdAvailabilityAlertSubscriber());
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriber
     */
    public function fromTransfer(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): FooAvailabilityAlertSubscriber
    {
        $entity = new FooAvailabilityAlertSubscriber();
        $entity->fromArray($availabilityAlertSubscriberTransfer->toArray());

        return $entity;
    }
}
