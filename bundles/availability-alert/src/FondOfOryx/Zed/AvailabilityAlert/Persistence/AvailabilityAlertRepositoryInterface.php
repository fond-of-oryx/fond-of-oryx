<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|null
     */
    public function findSubscriberByMail(string $email): ?AvailabilityAlertSubscriberTransfer;

    /**
     * @param int $idSubscriber
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|null
     */
    public function findSubscriberById(int $idSubscriber): ?AvailabilityAlertSubscriberTransfer;

    /**
     * @param string $mail
     * @param int $idProductAbstract
     * @param string $status
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|null
     */
    public function findSubscriptionByEmailAndIdProductAbstractAndStatus(
        string $mail,
        int $idProductAbstract,
        string $status
    ): ?AvailabilityAlertSubscriptionTransfer;

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return array
     */
    public function getCountOfSubscriberPerProductAbstract(): array;

    /**
     * @param int $idStore
     * @param string $status
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer
     */
    public function findSubscriptionsByIdStoreAndStatus(int $idStore, string $status): AvailabilityAlertSubscriptionCollectionTransfer;
}
