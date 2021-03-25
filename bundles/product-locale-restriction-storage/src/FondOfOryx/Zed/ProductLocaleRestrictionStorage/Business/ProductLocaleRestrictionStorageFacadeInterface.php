<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business;

interface ProductLocaleRestrictionStorageFacadeInterface
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void;
}
