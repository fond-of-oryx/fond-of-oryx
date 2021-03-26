<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

class ErpOrderMapper implements ErpOrderMapperInterface
{
    protected const SEARCH_RESULT_KEY_ERP_ORDERS = 'erp-orders';
    protected const ERP_ORDER_DATA_KEY_ERP_ORDER_ITEMS = 'erp_order_items';

    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function mapErpOrderResource(
        array $searchResults
    ): RestErpOrderPageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpOrderPageSearchCollectionResponseTransfer())->fromArray($searchResults, true);

        foreach ($searchResults[self::SEARCH_RESULT_KEY_ERP_ORDERS] as $erpOrderData) {
            $erpOrder = new ErpOrderTransfer();
            $erpOrder->fromArray($erpOrderData, true);
            $responseTransfer->addErpOrder(
                $this->mapErpOrderItemData($erpOrder, $erpOrderData[self::ERP_ORDER_DATA_KEY_ERP_ORDER_ITEMS])
            );
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
