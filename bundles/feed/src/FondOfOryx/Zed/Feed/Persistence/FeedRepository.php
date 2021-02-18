<?php

namespace FondOfOryx\Zed\Feed\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\Feed\Persistence\FeedPersistenceFactory getFactory()
 */
class FeedRepository extends AbstractRepository implements FeedRepositoryInterface
{
    /**
     * @param int $idStore
     * @param int $status
     *
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription[]
     */
    public function findSubscriptionsByIdStoreAndStatus(int $idStore, int $status): array
    {
        $data = $this->getFactory()->getAvailabilityAlertSubscriptionQuery()
            ->filterByFkStore($idStore)
            ->filterByStatus($status)->find();

        if ($data !== null) {
            return $data->getData();
        }

        return [];
    }

    /**
     * @param int $idStore
     *
     * @return array
     */
    public function getAllAvailabilityByStore(int $idStore): array
    {
        $data = $this->getFactory()->getAvailabilityQuery()->filterByFkStore($idStore)->find();

        if ($data !== null) {
            return $data->getData();
        }

        return [];
    }
}
