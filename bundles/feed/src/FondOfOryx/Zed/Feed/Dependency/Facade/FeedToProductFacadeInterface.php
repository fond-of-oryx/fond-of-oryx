<?php

namespace FondOfOryx\Zed\Feed\Dependency\Facade;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface FeedToProductFacadeInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer|null
     */
    public function findProductAbstractById(int $idProductAbstract): ?ProductAbstractTransfer;
}
