<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;

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
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ?SpyGiftCardProductAbstractConfigurationEntityTransfer;

    /**
     * Specifications:
     * - Save gift card product concrete configuration using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ?SpyGiftCardProductConfigurationEntityTransfer;
}
