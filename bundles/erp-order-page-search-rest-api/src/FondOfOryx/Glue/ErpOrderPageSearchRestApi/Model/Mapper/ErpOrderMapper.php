<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpOrderItemTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpOrderTotalTransfer;
use Generated\Shared\Transfer\RestErpOrderTransfer;

class ErpOrderMapper implements ErpOrderMapperInterface
{
    protected const SEARCH_RESULT_KEY_ERP_ORDERS = 'erp-orders';
    protected const ERP_ORDER_DATA_KEY_ERP_ORDER_ITEMS = 'erp_order_items';
    protected const ERP_ORDER_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';
    protected const ERP_ORDER_DATA_KEY_ERP_ORDER_TOTAL = 'erp_order_total';

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
            $restErpOrder->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpOrderData[static::ERP_ORDER_DATA_KEY_COMPANY_BUSINESS_UNIT]
                )
            );

            $this->addRestErpOrderItems($restErpOrder, $erpOrderData[self::ERP_ORDER_DATA_KEY_ERP_ORDER_ITEMS]);
            $restErpOrder->setTotal($this->mapErpOrderTotalToRestOrderTotal(
                $erpOrderData[static::ERP_ORDER_DATA_KEY_ERP_ORDER_TOTAL]
            ));

            $responseTransfer->addErpOrder($restErpOrder);
        }

        return $responseTransfer;
    }

    /**
     * @param array $companyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer
     */
    protected function mapCompanyBusinessUnitToRestCompanyBusinessUnit(
        array $companyBusinessUnit
    ): RestCompanyBusinessUnitTransfer {
        return (new RestCompanyBusinessUnitTransfer())->fromArray($companyBusinessUnit, true);
    }

    /**
     * @param array $erpOrderTotal
     *
     * @return \Generated\Shared\Transfer\RestErpOrderTotalTransfer
     */
    protected function mapErpOrderTotalToRestOrderTotal(
        array $erpOrderTotal
    ): RestErpOrderTotalTransfer {
        return (new RestErpOrderTotalTransfer())->fromArray($erpOrderTotal, true);
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
