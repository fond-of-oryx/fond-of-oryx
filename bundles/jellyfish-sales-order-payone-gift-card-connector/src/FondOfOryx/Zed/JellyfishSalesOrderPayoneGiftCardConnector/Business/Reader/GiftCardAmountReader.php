<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardAmountReader implements GiftCardAmountReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface $repository
     */
    public function __construct(
        JellyfishSalesOrderPayoneGiftCardConnectorRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int|null
     */
    public function getByItemTransfer(ItemTransfer $itemTransfer): ?int
    {
        $idSalesOrderItem = $itemTransfer->getIdSalesOrderItem();

        if ($idSalesOrderItem === null) {
            return null;
        }

        return $this->repository->findGiftCardAmountByIdSalesOrderItem($idSalesOrderItem);
    }
}
