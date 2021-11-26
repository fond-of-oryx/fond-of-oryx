<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use DateTime;
use FondOfOryx\Shared\ErpInvoice\ErpInvoiceConstants;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher;
use Generated\Shared\Search\ErpInvoiceIndexMap;

class ErpInvoicePageSearchDataMapper implements ErpInvoicePageSearchDataMapperInterface
{
    public const COMPANY_BUSINESS_UNIT = ErpInvoicePageSearchPublisher::COMPANY_BUSINESS_UNIT;
    public const ERP_INVOICE_ITEMS = ErpInvoicePageSearchPublisher::ERP_INVOICE_ITEMS;
    public const ERP_INVOICE_EXPENSES = ErpInvoicePageSearchPublisher::ERP_INVOICE_EXPENSES;
    public const ERP_INVOICE_TOTAL = ErpInvoicePageSearchPublisher::ERP_INVOICE_TOTAL;
    public const BILLING_ADDRESS = ErpInvoicePageSearchPublisher::BILLING_ADDRESS;
    public const SHIPPING_ADDRESS = ErpInvoicePageSearchPublisher::SHIPPING_ADDRESS;

    /**
     * @var string
     */
    public const ID_ERP_INVOICE = 'id_erp_invoice';

    /**
     * @var string
     */
    public const FK_BILLING_ADDRESS = 'fk_billing_address';

    /**
     * @var string
     */
    public const FK_SHIPPING_ADDRESS = 'fk_shipping_address';

    /**
     * @var string
     */
    public const FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';

    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT_UUID = 'uuid';

    /**
     * @var string
     */
    public const EXTERNAL_REFERENCE = 'external_reference';

    /**
     * @var string
     */
    public const REFERENCE = 'reference';

    /**
     * @var string
     */
    public const INVOICE_DATE = 'invoice_date';

    /**
     * @var string
     */
    public const CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const UPDATED_AT = 'updated_at';

    /**
     * @var string
     */
    public const DOCUMENT_NUMBER = 'document_number';

    /**
     * @var string
     */
    public const CURRENCY_ISO_CODE = 'currency_iso_code';

    /**
     * @var string
     */
    public const SEARCH_RESULT_INVOICE_DATE = 'invoice_date';

    /**
     * @var string
     */
    public const SEARCH_RESULT_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const SEARCH_RESULT_UPDATED_AT = 'updated_at';

    /**
     * @var string
     */
    public const SEARCH_RESULT_DOCUMENT_NUMBER = 'document_number';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ID_ERP_INVOICE = 'id_erp_invoice';

    /**
     * @var string
     */
    public const SEARCH_RESULT_FK_BILLING_ADDRESS = 'fk_billing_address';

    /**
     * @var string
     */
    public const SEARCH_RESULT_FK_SHIPPING_ADDRESS = 'fk_shipping_address';

    /**
     * @var string
     */
    public const SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';

    /**
     * @var string
     */
    public const SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID = 'company_business_unit_uuid';

    /**
     * @var string
     */
    public const SEARCH_RESULT_EXTERNAL_REFERENCE = 'external_reference';

    /**
     * @var string
     */
    public const SEARCH_RESULT_REFERENCE = 'reference';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_INVOICE_ITEMS = 'erp_invoice_items';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_INVOICE_EXPENSES = 'erp_invoice_expenses';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_INVOICE_TOTAL = 'erp_invoice_total';

    /**
     * @var string
     */
    public const SEARCH_RESULT_BILLING_ADDRESS = 'billing_address';

    /**
     * @var string
     */
    public const SEARCH_RESULT_SHIPPING_ADDRESS = 'shipping_address';

    /**
     * @var string
     */
    public const SEARCH_RESULT_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @var string
     */
    public const SEARCH_RESULT_CURRENCY_ISO_CODE = 'currency_iso_code';

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpInvoiceDataToSearchData(array $data): array
    {
        $searchData = [
            ErpInvoiceIndexMap::LOCALE => null,
            ErpInvoiceIndexMap::INVOICE_DATE => $this->convertDate($data[static::INVOICE_DATE]),
            ErpInvoiceIndexMap::CREATED_AT => $this->convertDate($data[static::CREATED_AT]),
            ErpInvoiceIndexMap::UPDATED_AT => $this->convertDate($data[static::UPDATED_AT]),
            ErpInvoiceIndexMap::DOCUMENT_NUMBER => $data[static::DOCUMENT_NUMBER],
            ErpInvoiceIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpInvoiceIndexMap::ID_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            ErpInvoiceIndexMap::REFERENCE => $data[static::REFERENCE],
            ErpInvoiceIndexMap::SEARCH_RESULT_DATA => $this->mapErpInvoiceDataToSearchResultData($data),
        ];

        return $searchData;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapErpInvoiceDataToSearchResultData(array $data): array
    {
        return [
            static::SEARCH_RESULT_INVOICE_DATE => $this->convertDate($data[static::INVOICE_DATE]),
            static::SEARCH_RESULT_CREATED_AT => $this->convertDate($data[static::CREATED_AT]),
            static::SEARCH_RESULT_UPDATED_AT => $this->convertDate($data[static::UPDATED_AT]),
            static::SEARCH_RESULT_DOCUMENT_NUMBER => $data[static::DOCUMENT_NUMBER],
            static::SEARCH_RESULT_ID_ERP_INVOICE => $data[static::ID_ERP_INVOICE],
            static::SEARCH_RESULT_FK_BILLING_ADDRESS => $data[static::FK_BILLING_ADDRESS],
            static::SEARCH_RESULT_FK_SHIPPING_ADDRESS => $data[static::FK_SHIPPING_ADDRESS],
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_REFERENCE => $data[static::REFERENCE],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT => $data[static::COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_ERP_INVOICE_ITEMS => $data[static::ERP_INVOICE_ITEMS],
            static::SEARCH_RESULT_ERP_INVOICE_EXPENSES => $data[static::ERP_INVOICE_EXPENSES],
            static::SEARCH_RESULT_ERP_INVOICE_TOTAL => $data[static::ERP_INVOICE_TOTAL],
            static::SEARCH_RESULT_SHIPPING_ADDRESS => $data[static::SHIPPING_ADDRESS],
            static::SEARCH_RESULT_BILLING_ADDRESS => $data[static::BILLING_ADDRESS],
            static::SEARCH_RESULT_CURRENCY_ISO_CODE => $data[static::CURRENCY_ISO_CODE],
        ];
    }

    /**
     * @param string|null $dateString
     *
     * @return string|null
     */
    protected function convertDate(?string $dateString): ?string
    {
        if ($dateString !== null) {
            $dateString = new DateTime($dateString);
            $dateString = $dateString->format(ErpInvoiceConstants::INVOICE_DATE_FORMAT);
        }

        return $dateString;
    }
}
