<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use DateTime;
use FondOfOryx\Shared\ErpOrder\ErpOrderConstants;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;
use Generated\Shared\Search\ErpOrderIndexMap;

class ErpOrderPageSearchDataMapper implements ErpOrderPageSearchDataMapperInterface
{
    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT = ErpOrderPageSearchPublisher::COMPANY_BUSINESS_UNIT;

    /**
     * @var string
     */
    public const ITEMS = ErpOrderPageSearchPublisher::ITEMS;

    /**
     * @var string
     */
    public const ERP_ORDER_EXPENSES = ErpOrderPageSearchPublisher::ERP_ORDER_EXPENSES;

    /**
     * @var string
     */
    public const TOTALS = ErpOrderPageSearchPublisher::TOTALS;

    /**
     * @var string
     */
    public const BILLING_ADDRESS = ErpOrderPageSearchPublisher::BILLING_ADDRESS;

    /**
     * @var string
     */
    public const SHIPPING_ADDRESS = ErpOrderPageSearchPublisher::SHIPPING_ADDRESS;

    /**
     * @var string
     */
    public const CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';

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
    public const ID_ERP_ORDER = 'id_erp_order';

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
    public const FK_TOTALS = 'fk_totals';

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
    public const CUSTOM_REFERENCE = 'custom_reference';

    /**
     * @var string
     */
    public const REFERENCE = 'reference';

    /**
     * @var string
     */
    public const CURRENCY_ISO_CODE = 'currency_iso_code';

    /**
     * @var string
     */
    public const IS_CANCELED = 'is_canceled';

    /**
     * @var string
     */
    public const OUTSTANDING_QUANTITY = 'outstanding_quantity';

    /**
     * @var string
     */
    public const PURCHASER_EMAIL = 'purchaser_email';

    /**
     * @var string
     */
    public const EXPECTED_DELIVERY_DATE = 'expected_delivery_date';

    /**
     * @var string
     */
    public const SEARCH_RESULT_CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';

    /**
     * @var string
     */
    public const SEARCH_RESULT_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ID_ERP_ORDER = 'id_erp_order';

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
    public const SEARCH_RESULT_FK_TOTALS = 'fk_totals';

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
    public const SEARCH_RESULT_CUSTOM_REFERENCE = 'custom_reference';

    /**
     * @var string
     */
    public const SEARCH_RESULT_REFERENCE = 'reference';

    /**
     * @var string
     */
    public const SEARCH_RESULT_IS_CANCELED = 'is_canceled';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ITEMS = 'items';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_ORDER_EXPENSES = 'erp_order_expenses';

    /**
     * @var string
     */
    public const SEARCH_RESULT_PURCHASER_EMAIL = 'purchaser_email';

    /**
     * @var string
     */
    public const SEARCH_RESULT_EXPECTED_DELIVERY_DATE = 'expected_delivery_date';

    /**
     * @var string
     */
    public const SEARCH_RESULT_PURCHASER_FIRST_NAME = 'purchaser_first_name';

    /**
     * @var string
     */
    public const SEARCH_RESULT_PURCHASER_LAST_NAME = 'purchaser_last_name';

    /**
     * @var string
     */
    public const SEARCH_RESULT_TOTALS = 'totals';

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

    protected AbstractFullTextMapper $fullTextMapper;

    protected AbstractFullTextMapper $fullTextBoostedMapper;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper $fullTextMapper
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper $fullTextBoostedMapper
     */
    public function __construct(
        AbstractFullTextMapper $fullTextMapper,
        AbstractFullTextMapper $fullTextBoostedMapper
    ) {
        $this->fullTextMapper = $fullTextMapper;
        $this->fullTextBoostedMapper = $fullTextBoostedMapper;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array
    {
        return [
            ErpOrderIndexMap::FULL_TEXT => $this->fullTextMapper->fromData($data),
            ErpOrderIndexMap::FULL_TEXT_BOOSTED => $this->fullTextBoostedMapper->fromData($data),
            ErpOrderIndexMap::CONCRETE_DELIVERY_DATE => $this->formatDate($data[static::CONCRETE_DELIVERY_DATE]),
            ErpOrderIndexMap::CREATED_AT => $this->formatDate($data[static::CREATED_AT]),
            ErpOrderIndexMap::UPDATED_AT => $this->formatDate($data[static::UPDATED_AT]),
            ErpOrderIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpOrderIndexMap::ID_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            ErpOrderIndexMap::OUTSTANDING_QUANTITY => $data[static::OUTSTANDING_QUANTITY],
            ErpOrderIndexMap::IS_CANCELED => $data[static::IS_CANCELED],
            ErpOrderIndexMap::PURCHASER_EMAIL => $data[static::PURCHASER_EMAIL],
            ErpOrderIndexMap::EXPECTED_DELIVERY_DATE => $this->formatDate($data[static::EXPECTED_DELIVERY_DATE]),
            ErpOrderIndexMap::SEARCH_RESULT_DATA => $this->mapErpOrderDataToSearchResultData($data),
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapErpOrderDataToSearchResultData(array $data): array
    {
        return [
            static::SEARCH_RESULT_CONCRETE_DELIVERY_DATE => $this->formatDate($data[static::CONCRETE_DELIVERY_DATE]),
            static::SEARCH_RESULT_CREATED_AT => $this->formatDate($data[static::CREATED_AT]),
            static::SEARCH_RESULT_ID_ERP_ORDER => $data[static::ID_ERP_ORDER],
            static::SEARCH_RESULT_FK_BILLING_ADDRESS => $data[static::FK_BILLING_ADDRESS],
            static::SEARCH_RESULT_FK_SHIPPING_ADDRESS => $data[static::FK_SHIPPING_ADDRESS],
            static::SEARCH_RESULT_FK_TOTALS => $data[static::FK_TOTALS],
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_CUSTOM_REFERENCE => $data[static::CUSTOM_REFERENCE],
            static::SEARCH_RESULT_REFERENCE => $data[static::REFERENCE],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT => $data[static::COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_ITEMS => $data[static::ITEMS],
            static::SEARCH_RESULT_ERP_ORDER_EXPENSES => $data[static::ERP_ORDER_EXPENSES],
            static::SEARCH_RESULT_TOTALS => $data[static::TOTALS],
            static::SEARCH_RESULT_SHIPPING_ADDRESS => $data[static::SHIPPING_ADDRESS],
            static::SEARCH_RESULT_BILLING_ADDRESS => $data[static::BILLING_ADDRESS],
            static::SEARCH_RESULT_CURRENCY_ISO_CODE => $data[static::CURRENCY_ISO_CODE],
            static::SEARCH_RESULT_IS_CANCELED => $data[static::IS_CANCELED],
            static::SEARCH_RESULT_PURCHASER_EMAIL => $data[static::SEARCH_RESULT_PURCHASER_EMAIL],
            static::SEARCH_RESULT_EXPECTED_DELIVERY_DATE => $this->formatDate($data[static::EXPECTED_DELIVERY_DATE]),
            static::SEARCH_RESULT_PURCHASER_FIRST_NAME => $data[static::SEARCH_RESULT_PURCHASER_FIRST_NAME],
            static::SEARCH_RESULT_PURCHASER_LAST_NAME => $data[static::SEARCH_RESULT_PURCHASER_LAST_NAME],
        ];
    }

    /**
     * @param string|null $date
     *
     * @return string|null
     */
    protected function formatDate(?string $date): ?string
    {
        if ($date !== null) {
            $date = new DateTime($date);
            $date = $date->format(ErpOrderConstants::DATE_FORMAT);
        }

        return $date;
    }
}
