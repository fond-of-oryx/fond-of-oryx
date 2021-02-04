<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use Generated\Shared\Search\ErpOrderIndexMap;

class ErpOrderPageSearchDataMapper implements ErpOrderPageSearchDataMapperInterface
{
    public const CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';
    public const ID_ERP_ORDER = 'id_erp_order';
    public const FK_BILLING_ADDRESS = 'fk_billing_address';
    public const FK_SHIPPING_ADDRESS = 'fk_shipping_address';
    public const FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';
    public const FK_COMPANY_USER = 'fk_company_user';
    public const EXTERNAL_REFERENCE = 'external_reference';
    public const REFERENCE = 'reference';

    public const SEARCH_RESULT_CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';
    public const SEARCH_RESULT_ID_ERP_ORDER = 'id_erp_order';
    public const SEARCH_RESULT_FK_BILLING_ADDRESS = 'fk_billing_address';
    public const SEARCH_RESULT_FK_SHIPPING_ADDRESS = 'fk_shipping_address';
    public const SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';
    public const SEARCH_RESULT_FK_COMPANY_USER = 'fk_company_user';
    public const SEARCH_RESULT_EXTERNAL_REFERENCE = 'external_reference';
    public const SEARCH_RESULT_REFERENCE = 'reference';

    /**
     * ErpOrderPageSearchDataMapper constructor.
     */
    public function __construct() {}

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array
    {
        $searchData = [
            ErpOrderIndexMap::LOCALE => null,
            ErpOrderIndexMap::CONCRETE_DELIVERY_DATE => $data[static::CONCRETE_DELIVERY_DATE],
            ErpOrderIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpOrderIndexMap::FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpOrderIndexMap::FK_COMPANY_USER => $data[static::FK_COMPANY_USER],
            ErpOrderIndexMap::REFERENCE => $data[static::REFERENCE],
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
            static::SEARCH_RESULT_CONCRETE_DELIVERY_DATE => $data[static::CONCRETE_DELIVERY_DATE],
            static::SEARCH_RESULT_ID_ERP_ORDER => $data[static::ID_ERP_ORDER],
            static::SEARCH_RESULT_FK_BILLING_ADDRESS => $data[static::FK_BILLING_ADDRESS],
            static::SEARCH_RESULT_FK_SHIPPING_ADDRESS => $data[static::FK_SHIPPING_ADDRESS],
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_FK_COMPANY_USER => $data[static::FK_COMPANY_USER],
            static::SEARCH_RESULT_REFERENCE => $data[static::REFERENCE],
        ];
    }
}
