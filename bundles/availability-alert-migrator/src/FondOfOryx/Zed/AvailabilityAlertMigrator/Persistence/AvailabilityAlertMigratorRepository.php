<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorPersistenceFactory getFactory()
 */
class AvailabilityAlertMigratorRepository extends AbstractRepository implements AvailabilityAlertMigratorRepositoryInterface
{
    /**
     * @param int $offset
     * @param int|null $limit
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer[]
     */
    public function getAllSubscriptions(int $offset = 0, ?int $limit = null): array
    {
        $query = $this->getFactory()->createFosAvailabilityAlertSubscriptionQuery();
        $query = $this->addFilter($query, $offset, $limit);

        $subscriptions = [];

        foreach ($query->find()->getData() as $subscription) {
            $subscriptions[] = $this->getFactory()->createAvailabilityAlertMigrationDataMapper()->fromFosAvailabilityAlertSubscription($subscription);
        }

        return $subscriptions;
    }

    /**
     * @return int
     */
    public function getSubscriptionCount(): int
    {
        return $this->getFactory()->createFosAvailabilityAlertSubscriptionQuery()->count();
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param int $offset
     * @param int|null $limit
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function addFilter(ModelCriteria $query, int $offset, ?int $limit = null): ModelCriteria
    {
        if ($limit !== null) {
            $query->limit($limit);
        }

        if ($offset > 0) {
            $query->offset($offset);
        }

        return $query;
    }
}
