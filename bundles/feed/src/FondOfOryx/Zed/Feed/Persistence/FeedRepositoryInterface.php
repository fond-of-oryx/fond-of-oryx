<?php

namespace FondOfOryx\Zed\Feed\Persistence;

/**
 * @method \FondOfOryx\Zed\Feed\Persistence\FeedPersistenceFactory getFactory()
 */
interface FeedRepositoryInterface
{
    /**
     * @param int $idStore
     * @param int $status
     *
     * @return array
     */
    public function findSubscriptionsByIdStoreAndStatus(int $idStore, int $status): array;

    /**
     * @param int $idStore
     *
     * @return array
     */
    public function getAllAvailabilityByStore(int $idStore): array;
}
