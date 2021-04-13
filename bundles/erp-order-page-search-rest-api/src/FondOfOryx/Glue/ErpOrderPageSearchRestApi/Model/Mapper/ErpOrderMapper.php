<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Generated\Shared\Transfer\RestErpOrderAddressTransfer;
use Generated\Shared\Transfer\RestErpOrderItemTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpOrderTransfer;

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

        if (
            empty($searchResults)
            || !array_key_exists(static::SEARCH_RESULT_KEY_ERP_ORDERS, $searchResults)
        ) {
            return $responseTransfer;
        }

        foreach ($searchResults[static::SEARCH_RESULT_KEY_ERP_ORDERS] as $erpOrderData) {
            $restErpOrder = new RestErpOrderTransfer();
            $restErpOrder->fromArray($erpOrderData, true);

            $this->addRestErpOrderItems($restErpOrder, $erpOrderData[self::ERP_ORDER_DATA_KEY_ERP_ORDER_ITEMS]);

            $responseTransfer->addErpOrder($restErpOrder);
        }

        return $responseTransfer;
    }

    /**
     * @param array $address
     *
     * @return \Generated\Shared\Transfer\RestErpOrderAddressTransfer
     */
    protected function mapErpOrderAddressToRestErpOrderAddress(array $address): RestErpOrderAddressTransfer
    {
        return (new RestErpOrderAddressTransfer())->fromArray($address, true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpOrderTransfer $restErpOrderTransfer
     * @param array $erpOrderItems
     *
     * @return \Generated\Shared\Transfer\RestErpOrderTransfer
     */
    protected function addRestErpOrderItems(
        RestErpOrderTransfer $restErpOrderTransfer,
        array $erpOrderItems
    ): RestErpOrderTransfer {
        foreach ($erpOrderItems as $erpOrderItemData) {
            $restErpOrderItemTransfer = (new RestErpOrderItemTransfer())->fromArray($erpOrderItemData, true);
            $restErpOrderTransfer->addItem($restErpOrderItemTransfer);
        }

        return $restErpOrderTransfer;
    }
}
