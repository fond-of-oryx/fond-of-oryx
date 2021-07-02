<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;

interface GiftCardProductAbstractConfigurationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ?SpyGiftCardProductAbstractConfigurationEntityTransfer;
}
