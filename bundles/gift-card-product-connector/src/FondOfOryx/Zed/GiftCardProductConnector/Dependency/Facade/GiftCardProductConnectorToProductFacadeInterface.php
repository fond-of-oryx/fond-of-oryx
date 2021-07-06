<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface GiftCardProductConnectorToProductFacadeInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer|null
     */
    public function findProductAbstractById(int $idProductAbstract): ?ProductAbstractTransfer;
}
