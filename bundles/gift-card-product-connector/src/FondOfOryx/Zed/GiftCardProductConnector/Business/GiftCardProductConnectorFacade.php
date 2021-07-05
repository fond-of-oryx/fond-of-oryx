<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface getEntityManager()
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
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {
        return $this->getFactory()
            ->createGiftCardProductAbstractConfigurationWriter()
            ->saveGiftCardProductAbstractConfiguration($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer {
        return $this->getFactory()
            ->createGiftCardProductConfigurationWriter()
            ->saveGiftCardProductConfiguration($productConcreteTransfer);
    }
}
