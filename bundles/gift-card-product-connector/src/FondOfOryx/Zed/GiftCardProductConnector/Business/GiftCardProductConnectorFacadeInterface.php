<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;

interface GiftCardProductConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Save gift card product abstract configuration using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer;

    /**
     * Specifications:
     * - Save gift card product concrete configuration using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer;
}
