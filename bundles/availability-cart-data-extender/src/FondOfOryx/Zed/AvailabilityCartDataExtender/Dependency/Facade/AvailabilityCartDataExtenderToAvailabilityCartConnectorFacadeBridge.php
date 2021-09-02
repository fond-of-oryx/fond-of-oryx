<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Spryker\Zed\AvailabilityCartConnector\Business\AvailabilityCartConnectorFacadeInterface;

class AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge implements AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface
{
    /**
     * @var \Spryker\Zed\AvailabilityCartConnector\Business\AvailabilityCartConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\AvailabilityCartConnector\Business\AvailabilityCartConnectorFacadeInterface $availabilityCartConnectorFacade
     */
    public function __construct(AvailabilityCartConnectorFacadeInterface $availabilityCartConnectorFacade)
    {
        $this->facade = $availabilityCartConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function checkCartAvailability(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        return $this->facade->checkCartAvailability($cartChangeTransfer);
    }
}
