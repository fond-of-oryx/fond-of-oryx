<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\FooAvailabilityAlertSubscriberEntityTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriber;

interface AvailabilityAlertSubscriberMapperInterface
{
    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriber $availabilityAlertSubscriber
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function fromEntity(FooAvailabilityAlertSubscriber $availabilityAlertSubscriber): AvailabilityAlertSubscriberTransfer;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\FooAvailabilityAlertSubscriberEntityTransfer
     */
    public function fromTransfer(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): FooAvailabilityAlertSubscriberEntityTransfer;
}
