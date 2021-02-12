<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

class ErpOrderMapper implements ErpOrderMapperInterface
{
    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function mapErpOrderResource(
        array $searchResults
    ): RestErpOrderPageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpOrderPageSearchCollectionResponseTransfer())->fromArray($searchResults, true);

        foreach ($searchResults['erp-orders'] as $erpOrderData) {
            $erpOrder = new ErpOrderTransfer();
            $erpOrder->fromArray($erpOrderData, true);
            $responseTransfer->addErpOrder($this->mapErpOrderItemData($erpOrder, $erpOrderData['erp_order_items']));
        }

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param array $erpOrderItems
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    protected function mapErpOrderItemData(ErpOrderTransfer $erpOrderTransfer, array $erpOrderItems): ErpOrderTransfer
    {
        foreach ($erpOrderItems as $erpOrderItemData) {
            $erpOrderItemTransfer = (new ErpOrderItemTransfer())->fromArray($erpOrderItemData, true);
            $erpOrderTransfer->addOrderItem($erpOrderItemTransfer);
        }

        return $erpOrderTransfer;
    }
}
