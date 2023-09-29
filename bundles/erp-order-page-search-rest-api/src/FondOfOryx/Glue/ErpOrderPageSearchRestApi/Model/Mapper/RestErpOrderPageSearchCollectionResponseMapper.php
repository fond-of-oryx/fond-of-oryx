<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpOrderExpenseTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpOrderTotalTransfer;
use Generated\Shared\Transfer\RestErpOrderTransfer;

class RestErpOrderPageSearchCollectionResponseMapper implements RestErpOrderPageSearchCollectionResponseMapperInterface
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
     * @var string
     */
    protected const ERP_ORDER_DATA_KEY_ERP_ORDER_EXPENSES = 'erp_order_expenses';

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapperInterface
     */
    protected $restErpOrderPageSearchPaginationMapper;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapperInterface
     */
    protected $restErpOrderPageSearchPaginationSortMapper;

    /**
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapperInterface $restErpOrderPageSearchPaginationMapper
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapperInterface $restErpOrderPageSearchPaginationSortMapper
     */
    public function __construct(
        RestErpOrderPageSearchPaginationMapperInterface $restErpOrderPageSearchPaginationMapper,
        RestErpOrderPageSearchPaginationSortMapperInterface $restErpOrderPageSearchPaginationSortMapper
    ) {
        $this->restErpOrderPageSearchPaginationMapper = $restErpOrderPageSearchPaginationMapper;
        $this->restErpOrderPageSearchPaginationSortMapper = $restErpOrderPageSearchPaginationSortMapper;
    }

    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpOrderPageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpOrderPageSearchCollectionResponseTransfer())
            ->setSort($this->restErpOrderPageSearchPaginationSortMapper->fromSearchResult($searchResult))
            ->setPagination($this->restErpOrderPageSearchPaginationMapper->fromSearchResult($searchResult));

        if (
            !array_key_exists(static::SEARCH_RESULT_KEY_ERP_ORDERS, $searchResult)
            || !is_array($searchResult[static::SEARCH_RESULT_KEY_ERP_ORDERS])
        ) {
            return $responseTransfer;
        }

        foreach ($searchResult[static::SEARCH_RESULT_KEY_ERP_ORDERS] as $erpOrderData) {
            $restErpOrder = new RestErpOrderTransfer();
            $restErpOrder->fromArray($erpOrderData, true);
            $restErpOrder->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpOrderData[static::ERP_ORDER_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            if (array_key_exists(static::ERP_ORDER_DATA_KEY_ERP_ORDER_EXPENSES, $erpOrderData)){
                $this->addRestErpOrderExpenses($restErpOrder, $erpOrderData[static::ERP_ORDER_DATA_KEY_ERP_ORDER_EXPENSES]);
            }

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

    /**
     * @param \Generated\Shared\Transfer\RestErpOrderTransfer $restErpOrderTransfer
     * @param array $erpOrderExpenses
     *
     * @return \Generated\Shared\Transfer\RestErpOrderTransfer
     */
    protected function addRestErpOrderExpenses(
        RestErpOrderTransfer $restErpOrderTransfer,
        array $erpOrderExpenses
    ): RestErpOrderTransfer {
        foreach ($erpOrderExpenses as $erpOrderExpenseData) {
            $restErpOrderItemTransfer = (new RestErpOrderExpenseTransfer())->fromArray($erpOrderExpenseData, true);
            $restErpOrderTransfer->addExpense($restErpOrderItemTransfer);
        }

        return $restErpOrderTransfer;
    }
}
