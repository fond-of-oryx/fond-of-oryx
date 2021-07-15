<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business;

use FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizer;
use FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ShipmentCartCodeConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizerInterface
     */
    public function createShipmentSanitizer(): ShipmentSanitizerInterface
    {
        return new ShipmentSanitizer();
    }
}
