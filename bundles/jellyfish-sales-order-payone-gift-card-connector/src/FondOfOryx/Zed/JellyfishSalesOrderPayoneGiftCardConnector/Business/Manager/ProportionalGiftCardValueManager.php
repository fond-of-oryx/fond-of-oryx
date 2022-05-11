<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class ProportionalGiftCardValueManager implements ProportionalGiftCardValueManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface $entityManager
     */
    public function __construct(JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return void
     */
    public function persistProportionalGiftCardValuesFromExport(JellyfishOrderTransfer $jellyfishOrderTransfer): void
    {
        foreach ($jellyfishOrderTransfer->getGiftCardBalances() as $balance) {
            $this->entityManager->findOrCreateProportionalGiftCardValue($balance);
        }
    }
}
