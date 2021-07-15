<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorBusinessFactory getFactory()
 */
class ShipmentCartCodeConnectorFacade extends AbstractFacade implements ShipmentCartCodeConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function sanitizeShipment(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createShipmentSanitizer()->sanitize($quoteTransfer);
    }
}
