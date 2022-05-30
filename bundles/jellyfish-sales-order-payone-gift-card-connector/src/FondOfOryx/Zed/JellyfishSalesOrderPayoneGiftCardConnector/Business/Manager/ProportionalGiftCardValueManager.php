<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class ProportionalGiftCardValueManager implements ProportionalGiftCardValueManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected $giftCardConnectorToGiftCardProportionalValueFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
     */
    public function __construct(
        JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
    ) {
        $this->giftCardConnectorToGiftCardProportionalValueFacade = $giftCardConnectorToGiftCardProportionalValueFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalGiftCardValuesFromExport(JellyfishOrderTransfer $jellyfishOrderTransfer): void
    {
        foreach ($jellyfishOrderTransfer->getGiftCardBalances() as $balance) {
            $this->giftCardConnectorToGiftCardProportionalValueFacade->findOrCreateProportionalGiftCardValue($balance);
        }
    }
}
