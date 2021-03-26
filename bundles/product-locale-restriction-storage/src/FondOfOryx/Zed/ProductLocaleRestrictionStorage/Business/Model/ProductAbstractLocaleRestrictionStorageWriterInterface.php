<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model;

interface ProductAbstractLocaleRestrictionStorageWriterInterface
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void;
}
