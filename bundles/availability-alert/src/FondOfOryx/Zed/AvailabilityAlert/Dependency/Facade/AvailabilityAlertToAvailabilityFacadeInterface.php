<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\ProductAbstractAvailabilityTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface AvailabilityAlertToAvailabilityFacadeInterface
{
    /**
     * @param int $idProductAbstract
     * @param int $idLocale
     *
     * @return \Generated\Shared\Transfer\ProductAbstractAvailabilityTransfer
     */
    public function getProductAbstractAvailability(int $idProductAbstract, int $idLocale): ProductAbstractAvailabilityTransfer;

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractAvailabilityTransfer|null
     */
    public function findOrCreateProductAbstractAvailabilityBySkuForStore(string $sku, StoreTransfer $storeTransfer): ?ProductAbstractAvailabilityTransfer;
}
