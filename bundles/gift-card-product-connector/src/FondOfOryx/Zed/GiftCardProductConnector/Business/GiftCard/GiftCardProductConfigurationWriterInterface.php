<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;


use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;

interface GiftCardProductConfigurationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ?SpyGiftCardProductConfigurationEntityTransfer;
}
