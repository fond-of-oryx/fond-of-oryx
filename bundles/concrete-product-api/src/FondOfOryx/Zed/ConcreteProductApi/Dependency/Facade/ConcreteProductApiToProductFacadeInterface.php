<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade;

use Generated\Shared\Transfer\ProductConcreteTransfer;

interface ConcreteProductApiToProductFacadeInterface
{
    /**
     * @param int $idProduct
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer|null
     */
    public function findProductConcreteById(int $idProduct): ?ProductConcreteTransfer;
}
