<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface GiftCardProductAbstractConfigurationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer;
}
