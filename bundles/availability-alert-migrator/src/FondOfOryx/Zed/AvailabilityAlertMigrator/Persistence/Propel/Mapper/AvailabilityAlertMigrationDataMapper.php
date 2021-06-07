<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper;

use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription;

class AvailabilityAlertMigrationDataMapper implements AvailabilityAlertMigrationDataMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface
     */
    protected $expander;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface $expander
     */
    public function __construct(ExpanderInterface $expander)
    {
        $this->expander = $expander;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function fromFosAvailabilityAlertSubscription(FosAvailabilityAlertSubscription $availabilityAlertSubscription): AvailabilityAlertSubscriptionTransfer
    {
        $subscription = $this->mapSubscriptionData($availabilityAlertSubscription);
        $subscription->setSubscriber($this->mapSubscriberData($availabilityAlertSubscription));
        $availabilityAlertSubscriptionTransfer = (new FosAvailabilityAlertSubscriptionEntityTransfer())->fromArray($availabilityAlertSubscription->toArray(), true);

        return $this->expander->expand($availabilityAlertSubscriptionTransfer, $subscription);
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    protected function mapSubscriberData(
        FosAvailabilityAlertSubscription $availabilityAlertSubscription
    ): AvailabilityAlertSubscriberTransfer {
        return (new AvailabilityAlertSubscriberTransfer())
            ->setEmail($availabilityAlertSubscription->getEmail())
            ->setBusinessUnit($availabilityAlertSubscription->getSpyLocale()->getLocaleName());
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    protected function mapSubscriptionData(
        FosAvailabilityAlertSubscription $availabilityAlertSubscription
    ): AvailabilityAlertSubscriptionTransfer {
        return (new AvailabilityAlertSubscriptionTransfer())
            ->setSentAt($availabilityAlertSubscription->getSentAt() !== null ? $availabilityAlertSubscription->getSentAt()->getTimestamp() : null)
            ->setCreatedAt($availabilityAlertSubscription->getCreatedAt() !== null ? $availabilityAlertSubscription->getCreatedAt()->getTimestamp() : null)
            ->setUpdatedAt(time())
            ->setFkProductAbstract($availabilityAlertSubscription->getFkProductAbstract())
            ->setStatus($availabilityAlertSubscription->getStatus())
            ->setFkLocale($availabilityAlertSubscription->getFkLocale())
            ->setFkStore($availabilityAlertSubscription->getFkStore());
    }
}
