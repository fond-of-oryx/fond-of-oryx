<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory getFactory()
 */
class JellyfishSalesOrderPayoneGiftCardConnectorRepository extends AbstractRepository implements JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null
     */
    public function findProportionalGiftCardValue(ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer): ?ProportionalGiftCardValueTransfer
    {
        $proportionalGiftCardValueTransfer->requireSku()->requireValue()->requireOrderReference();

        $query = $this->getFactory()->createProportionalGiftCardValueQuery();
        $query
            ->filterBySku($proportionalGiftCardValueTransfer->getSku())
            ->filterByValue($proportionalGiftCardValueTransfer->getValue())
            ->filterByOrderreference($proportionalGiftCardValueTransfer->getOrderReference());

        $result = $query->findOne();

        return $result === null ? null : $this->getFactory()->createProportionalGiftCardValueMapper()->mapEntityToTransfer($result);
    }
}
