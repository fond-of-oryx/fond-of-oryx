<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpOrderTotalTransfer;
use Generated\Shared\Transfer\RestErpOrderTransfer;

class ErpOrderMapper implements ErpOrderMapperInterface
{
    /**
     * @var string
     */
    protected const SEARCH_RESULT_KEY_ERP_ORDERS = 'erp-orders';

    /**
     * @var string
     */
    protected const ERP_ORDER_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @var string
     */
    protected const ERP_ORDER_DATA_KEY_TOTALS = 'totals';

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
            !array_key_exists(static::SEARCH_RESULT_KEY_ERP_ORDERS, $searchResults)
            || !is_array($searchResults[static::SEARCH_RESULT_KEY_ERP_ORDERS])
        ) {
            return $responseTransfer;
        }

        foreach ($searchResults[static::SEARCH_RESULT_KEY_ERP_ORDERS] as $erpOrderData) {
            $restErpOrder = new RestErpOrderTransfer();
            $restErpOrder->fromArray($erpOrderData, true);
            $restErpOrder->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpOrderData[static::ERP_ORDER_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            $restErpOrder->setTotals($this->mapErpOrderTotalToRestOrderTotal(
                $erpOrderData[static::ERP_ORDER_DATA_KEY_TOTALS],
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
}
