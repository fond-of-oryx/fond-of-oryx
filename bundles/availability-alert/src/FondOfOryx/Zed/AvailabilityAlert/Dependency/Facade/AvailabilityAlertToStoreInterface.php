<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface AvailabilityAlertToStoreInterface
{
    /**
     * @param string $store
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStore(string $store): StoreTransfer;

    /**
     * Specification
     *  - Read store by primary id from database
     *
     * @api
     *
     * @param int $idStore
     *
     * @throws \Spryker\Zed\Store\Business\Model\Exception\StoreNotFoundException
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreById(int $idStore): StoreTransfer;

    /**
     * Specification:
     *  - Returns currently selected store transfer
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
