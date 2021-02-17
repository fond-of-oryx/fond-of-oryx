<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use Orm\Zed\AvailabilityAlert\Persistence\Map\FosAvailabilityAlertSubscriptionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertPersistenceFactory getFactory()
 */
class AvailabilityAlertQueryContainer extends AbstractQueryContainer implements AvailabilityAlertQueryContainerInterface
{
    /**
     * @param string $email
     * @param int $idProductAbstract
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionByEmailAndIdProductAbstractAndStatus($email, $idProductAbstract, $status)
    {
        return $this->querySubscriptionByEmailAndIdProductAbstract($email, $idProductAbstract)
            ->filterByStatus($status);
    }

    /**
     * @param string $email
     * @param int $idProductAbstract
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionByEmailAndIdProductAbstract($email, $idProductAbstract)
    {
        return $this->querySubscription()
            ->filterByEmail($email)
            ->filterByFkProductAbstract($idProductAbstract);
    }

    /**
     * @api
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscription()
    {
        return $this->getFactory()->createAvailabilityAlertSubscriptionQuery();
    }

    /**
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByStatus($status)
    {
        return $this->querySubscription()
            ->filterByStatus($status);
    }

    /**
     * @param int $idStore
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByIdStoreAndStatus($idStore, $status)
    {
        return $this->querySubscription()
            ->filterByFkStore($idStore)
            ->filterByStatus($status);
    }

    /**
     * @param int $idProductAbstract
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function querySubscriptionsByIdProductAbstractAndStatus($idProductAbstract, $status)
    {
        return $this->querySubscriptionsByStatus($status)
            ->filterByFkProductAbstract($idProductAbstract);
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function queryCountOfSubscriberPerProductAbstract()
    {
        return $this->querySubscriptionsByStatus(FosAvailabilityAlertSubscriptionTableMap::COL_STATUS_PENDING)
            ->withColumn('COUNT(*)', 'count_of_subscriber')
            ->select(['count_of_subscriber', FosAvailabilityAlertSubscriptionTableMap::COL_FK_PRODUCT_ABSTRACT])
            ->groupByFkProductAbstract();
    }
}
