<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use DateTime;
use FondOfOryx\Shared\ErpOrder\ErpOrderConstants;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;
use Generated\Shared\Search\ErpOrderIndexMap;

class ErpOrderPageSearchDataMapper implements ErpOrderPageSearchDataMapperInterface
{
    public const COMPANY_BUSINESS_UNIT = ErpOrderPageSearchPublisher::COMPANY_BUSINESS_UNIT;
    public const ERP_ORDER_ITEMS = ErpOrderPageSearchPublisher::ERP_ORDER_ITEMS;
    public const ERP_ORDER_TOTAL = ErpOrderPageSearchPublisher::ERP_ORDER_TOTAL;
    public const BILLING_ADDRESS = ErpOrderPageSearchPublisher::BILLING_ADDRESS;
    public const SHIPPING_ADDRESS = ErpOrderPageSearchPublisher::SHIPPING_ADDRESS;
    public const ERP_INVOICES = ErpOrderPageSearchPublisher::ERP_INVOICES;
    public const CART_NOTE = ErpOrderPageSearchPublisher::CART_NOTE;

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
    public const CURRENCY_ISO_CODE = 'currency_iso_code';

    /**
     * @var string
     */
    public const OUTSTANDING_QUANTITY = 'outstanding_quantity';

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
    public const SEARCH_RESULT_ERP_ORDER_ITEMS = 'erp_order_items';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_ORDER_TOTAL = 'erp_order_total';

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
     * @var string
     */
    public const SEARCH_RESULT_ERP_INVOICES = 'erp_invoices';

    /**
     * @var string
     */
    public const SEARCH_RESULT_CART_NOTE = 'cart_note';

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array
    {
        $searchData = [
            ErpOrderIndexMap::LOCALE => null,
            ErpOrderIndexMap::CONCRETE_DELIVERY_DATE => $this->formatDate($data[static::CONCRETE_DELIVERY_DATE]),
            ErpOrderIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpOrderIndexMap::ID_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            ErpOrderIndexMap::REFERENCE => $data[static::REFERENCE],
            ErpOrderIndexMap::OUTSTANDING_QUANTITY => $data[static::OUTSTANDING_QUANTITY],
            ErpOrderIndexMap::SEARCH_RESULT_DATA => $this->mapErpOrderDataToSearchResultData($data),
        ];

        return $searchData;
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
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_REFERENCE => $data[static::REFERENCE],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT => $data[static::COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_ERP_ORDER_ITEMS => $data[static::ERP_ORDER_ITEMS],
            static::SEARCH_RESULT_ERP_ORDER_TOTAL => $data[static::ERP_ORDER_TOTAL],
            static::SEARCH_RESULT_SHIPPING_ADDRESS => $data[static::SHIPPING_ADDRESS],
            static::SEARCH_RESULT_BILLING_ADDRESS => $data[static::BILLING_ADDRESS],
            static::SEARCH_RESULT_CURRENCY_ISO_CODE => $data[static::CURRENCY_ISO_CODE],
            static::SEARCH_RESULT_ERP_INVOICES => $data[static::ERP_INVOICES],
            static::SEARCH_RESULT_CART_NOTE => $data[static::CART_NOTE],
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
