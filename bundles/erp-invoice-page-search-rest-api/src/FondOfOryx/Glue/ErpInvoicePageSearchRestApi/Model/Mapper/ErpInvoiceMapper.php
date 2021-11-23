<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\RestErpInvoiceItemTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpInvoiceTransfer;

class ErpInvoiceMapper implements ErpInvoiceMapperInterface
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
    protected const ERP_INVOICE_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @var string
     */
    protected const ERP_INVOICE_DATA_KEY_ERP_INVOICE_TOTAL = 'erp_invoice_total';

    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function mapErpInvoiceResource(
        array $searchResults
    ): RestErpInvoicePageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpInvoicePageSearchCollectionResponseTransfer())->fromArray($searchResults, true);

        if (
            empty($searchResults)
            || !array_key_exists(static::SEARCH_RESULT_KEY_ERP_INVOICES, $searchResults)
        ) {
            return $responseTransfer;
        }

        foreach ($searchResults[static::SEARCH_RESULT_KEY_ERP_INVOICES] as $erpInvoiceData) {
            $restErpInvoice = new RestErpInvoiceTransfer();
            $restErpInvoice->fromArray($erpInvoiceData, true);
            $restErpInvoice->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpInvoiceData[static::ERP_INVOICE_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            $this->addRestErpInvoiceItems($restErpInvoice, $erpInvoiceData[self::ERP_INVOICE_DATA_KEY_ERP_INVOICE_ITEMS]);
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
}
