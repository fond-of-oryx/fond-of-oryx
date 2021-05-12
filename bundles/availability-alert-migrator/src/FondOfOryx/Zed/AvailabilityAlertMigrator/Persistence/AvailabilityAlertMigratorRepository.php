<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FosAvailabilityAlertSubscriptionTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorPersistenceFactory getFactory()
 */
class AvailabilityAlertMigratorRepository extends AbstractRepository implements AvailabilityAlertMigratorRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer[]
     */
    public function getAllSubscriptions(AvailabilityAlertMigratorFilterTransfer $filterTransfer): array
    {
        $query = $this->getFactory()->createFosAvailabilityAlertSubscriptionQuery();
        $query->filterByFkStore($this->getFactory()->getStoreFacade()->getCurrentStore()->getIdStore());
        $query = $this->appendLimitAndOffset($query, $filterTransfer);
        $query = $this->appendMigratedFilter($query, $filterTransfer);

        $query->orderBy(FosAvailabilityAlertSubscriptionTableMap::COL_ID_AVAILABILITY_ALERT_SUBSCRIPTION);

        $subscriptions = [];

        foreach ($query->find()->getData() as $subscription) {
            $subscriptions[] = $this->getFactory()->createAvailabilityAlertMigrationDataMapper()->fromFosAvailabilityAlertSubscription($subscription);
        }

        return $subscriptions;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return int
     */
    public function getSubscriptionCount(AvailabilityAlertMigratorFilterTransfer $filterTransfer): int
    {
        $query = $this->getFactory()->createFosAvailabilityAlertSubscriptionQuery();
        $query->filterByFkStore($this->getFactory()->getStoreFacade()->getCurrentStore()->getIdStore());

        return $this->appendMigratedFilter($query, $filterTransfer)->count();
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function appendLimitAndOffset(ModelCriteria $query, AvailabilityAlertMigratorFilterTransfer $filterTransfer): ModelCriteria
    {
        if ($filterTransfer->getLimit() !== null) {
            $query->limit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset() > 0) {
            $query->offset($filterTransfer->getOffset());
        }

        return $query;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function appendMigratedFilter(ModelCriteria $query, AvailabilityAlertMigratorFilterTransfer $filterTransfer): ModelCriteria
    {
        if ($filterTransfer->getFindOnlyNotMigratedSubscription() !== null) {
            $query->filterBy(ucfirst(str_replace(sprintf('%s.', FosAvailabilityAlertSubscriptionTableMap::TABLE_NAME), '', FosAvailabilityAlertSubscriptionTableMap::COL_MIGRATED)), !$filterTransfer->getFindOnlyNotMigratedSubscription());
        }

        return $query;
    }
}
