<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Manager;

use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class ProportionalGiftCardValueManager implements ProportionalGiftCardValueManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected $giftCardConnectorToGiftCardProportionalValueFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
     */
    public function __construct(
        JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
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
