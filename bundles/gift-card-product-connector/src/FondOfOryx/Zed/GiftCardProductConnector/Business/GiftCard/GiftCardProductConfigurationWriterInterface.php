<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use Generated\Shared\Transfer\ProductConcreteTransfer;

interface GiftCardProductConfigurationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer;
}
