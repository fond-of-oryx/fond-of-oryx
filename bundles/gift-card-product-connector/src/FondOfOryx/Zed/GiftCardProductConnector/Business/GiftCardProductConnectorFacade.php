<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorBusinessFactory getFactory()
 */
class GiftCardProductConnectorFacade extends AbstractFacade implements GiftCardProductConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ?SpyGiftCardProductAbstractConfigurationEntityTransfer {
        $this->getFactory()
            ->createGiftCardProductAbstractConfigurationWriter()
            ->saveGiftCardProductAbstractConfiguration($productAbstractTransfer);
    }

    /**
     *{@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer|null
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ?SpyGiftCardProductConfigurationEntityTransfer {
        $this->getFactory()
            ->createGiftCardProductConfigurationWriter()
            ->saveGiftCardProductConfiguration($productConcreteTransfer);
    }
}
