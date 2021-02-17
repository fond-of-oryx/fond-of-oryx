<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

interface AvailabilityAlertQueryContainerInterface
{
    /**
     * @param string $email
     * @param int $idProductAbstract
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionByEmailAndIdProductAbstractAndStatus($email, $idProductAbstract, $status);

    /**
     * @param string $email
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionByEmailAndIdProductAbstract($email, $idProductAbstract);

    /**
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByStatus($status);

    /**
     * @param int $idStore
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByIdStoreAndStatus($idStore, $status);

    /**
     * @param int $idProductAbstract
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByIdProductAbstractAndStatus($idProductAbstract, $status);

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function queryCountOfSubscriberPerProductAbstract();
}
