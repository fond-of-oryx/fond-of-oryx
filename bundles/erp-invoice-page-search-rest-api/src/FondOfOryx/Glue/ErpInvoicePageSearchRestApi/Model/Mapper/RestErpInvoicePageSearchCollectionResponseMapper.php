<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\RestErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\RestErpInvoiceItemTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpInvoiceTransfer;

class RestErpInvoicePageSearchCollectionResponseMapper implements RestErpInvoicePageSearchCollectionResponseMapperInterface
{
    /**
     * @var string
     */
    protected const SEARCH_RESULT_KEY_ERP_INVOICES = 'erp-invoices';

    /**
     * @var string
     */
    protected const ERP_INVOICE_DATA_KEY_ERP_INVOICE_ITEMS = 'erp_invoice_items';

    /**
     * @var string
     */
    protected const ERP_INVOICE_DATA_KEY_ERP_INVOICE_EXPENSES = 'erp_invoice_expenses';

    /**
     * @var string
     */
    protected const ERP_INVOICE_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @var string
     */
    protected const ERP_INVOICE_DATA_KEY_ERP_INVOICE_TOTAL = 'erp_invoice_total';

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapperInterface
     */
    protected $restErpInvoicePageSearchPaginationMapper;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapperInterface
     */
    protected $restErpInvoicePageSearchPaginationSortMapper;

    /**
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapperInterface $restErpInvoicePageSearchPaginationMapper
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapperInterface $restErpInvoicePageSearchPaginationSortMapper
     */
    public function __construct(
        RestErpInvoicePageSearchPaginationMapperInterface $restErpInvoicePageSearchPaginationMapper,
        RestErpInvoicePageSearchPaginationSortMapperInterface $restErpInvoicePageSearchPaginationSortMapper
    ) {
        $this->restErpInvoicePageSearchPaginationMapper = $restErpInvoicePageSearchPaginationMapper;
        $this->restErpInvoicePageSearchPaginationSortMapper = $restErpInvoicePageSearchPaginationSortMapper;
    }

    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpInvoicePageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpInvoicePageSearchCollectionResponseTransfer())
            ->setSort($this->restErpInvoicePageSearchPaginationSortMapper->fromSearchResult($searchResult))
            ->setPagination($this->restErpInvoicePageSearchPaginationMapper->fromSearchResult($searchResult));

        if (
            !array_key_exists(static::SEARCH_RESULT_KEY_ERP_INVOICES, $searchResult)
            || !is_array($searchResult[static::SEARCH_RESULT_KEY_ERP_INVOICES])
        ) {
            return $responseTransfer;
        }

        foreach ($searchResult[static::SEARCH_RESULT_KEY_ERP_INVOICES] as $erpInvoiceData) {
            $restErpInvoice = new RestErpInvoiceTransfer();
            $restErpInvoice->fromArray($erpInvoiceData, true);
            $restErpInvoice->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpInvoiceData[static::ERP_INVOICE_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            $this->addRestErpInvoiceItems($restErpInvoice, $erpInvoiceData[self::ERP_INVOICE_DATA_KEY_ERP_INVOICE_ITEMS]);
            $this->addRestErpInvoiceExpenses($restErpInvoice, $erpInvoiceData[self::ERP_INVOICE_DATA_KEY_ERP_INVOICE_EXPENSES]);
            $restErpInvoice->setTotals($this->mapErpInvoiceTotalToRestOrderTotal(
                $erpInvoiceData[static::ERP_INVOICE_DATA_KEY_ERP_INVOICE_TOTAL],
            ));

            $responseTransfer->addErpInvoice($restErpInvoice);
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
     * @param array $erpInvoiceTotal
     *
     * @return \Generated\Shared\Transfer\RestErpInvoiceAmountTransfer
     */
    protected function mapErpInvoiceTotalToRestOrderTotal(
        array $erpInvoiceTotal
    ): RestErpInvoiceAmountTransfer {
        return (new RestErpInvoiceAmountTransfer())->fromArray($erpInvoiceTotal, true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpInvoiceTransfer $restErpInvoiceTransfer
     * @param array $erpInvoiceItems
     *
     * @return \Generated\Shared\Transfer\RestErpInvoiceTransfer
     */
    protected function addRestErpInvoiceItems(
        RestErpInvoiceTransfer $restErpInvoiceTransfer,
        array $erpInvoiceItems
    ): RestErpInvoiceTransfer {
        foreach ($erpInvoiceItems as $erpInvoiceItemData) {
            $restErpInvoiceItemTransfer = (new RestErpInvoiceItemTransfer())->fromArray($erpInvoiceItemData, true);
            $restErpInvoiceTransfer->addItem($restErpInvoiceItemTransfer);
        }

        return $restErpInvoiceTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpInvoiceTransfer $restErpInvoiceTransfer
     * @param array $erpInvoiceExpenses
     *
     * @return \Generated\Shared\Transfer\RestErpInvoiceTransfer
     */
    protected function addRestErpInvoiceExpenses(
        RestErpInvoiceTransfer $restErpInvoiceTransfer,
        array $erpInvoiceExpenses
    ): RestErpInvoiceTransfer {
        foreach ($erpInvoiceExpenses as $erpInvoiceExpenseData) {
            $restErpInvoiceItemTransfer = (new RestErpInvoiceExpenseTransfer())->fromArray($erpInvoiceExpenseData, true);
            $restErpInvoiceTransfer->addExpense($restErpInvoiceItemTransfer);
        }

        return $restErpInvoiceTransfer;
    }
}
