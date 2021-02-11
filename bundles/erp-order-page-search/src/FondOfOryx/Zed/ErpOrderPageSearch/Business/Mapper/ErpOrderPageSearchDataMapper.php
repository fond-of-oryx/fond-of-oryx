<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use DateTime;
use FondOfOryx\Shared\ErpOrder\ErpOrderConstants;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;
use Generated\Shared\Search\ErpOrderIndexMap;

class ErpOrderPageSearchDataMapper implements ErpOrderPageSearchDataMapperInterface
{
    public const COMPANY_BUSINESS_UNIT = ErpOrderPageSearchPublisher::COMPANY_BUSINESS_UNIT;
    public const COMPANY_USER = ErpOrderPageSearchPublisher::COMPANY_USER;
    public const ERP_ORDER_ITEMS = ErpOrderPageSearchPublisher::ERP_ORDER_ITEMS;
    public const BILLING_ADDRESS = ErpOrderPageSearchPublisher::BILLING_ADDRESS;
    public const SHIPPING_ADDRESS = ErpOrderPageSearchPublisher::SHIPPING_ADDRESS;

    public const CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';
    public const ID_ERP_ORDER = 'id_erp_order';
    public const FK_BILLING_ADDRESS = 'fk_billing_address';
    public const FK_SHIPPING_ADDRESS = 'fk_shipping_address';
    public const FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';
    public const COMPANY_BUSINESS_UNIT_UUID = 'uuid';
    public const FK_COMPANY_USER = 'fk_company_user';
    public const COMPANY_USER_REFERENCE = 'company_user_reference';
    public const EXTERNAL_REFERENCE = 'external_reference';
    public const REFERENCE = 'reference';

    public const SEARCH_RESULT_CONCRETE_DELIVERY_DATE = 'concrete_delivery_date';
    public const SEARCH_RESULT_ID_ERP_ORDER = 'id_erp_order';
    public const SEARCH_RESULT_FK_BILLING_ADDRESS = 'fk_billing_address';
    public const SEARCH_RESULT_FK_SHIPPING_ADDRESS = 'fk_shipping_address';
    public const SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT = 'fk_company_business_unit';
    public const SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID = 'company_business_unit_uuid';
    public const SEARCH_RESULT_FK_COMPANY_USER = 'fk_company_user';
    public const SEARCH_RESULT_COMPANY_USER_REFERENCE = 'company_user_reference';
    public const SEARCH_RESULT_EXTERNAL_REFERENCE = 'external_reference';
    public const SEARCH_RESULT_REFERENCE = 'reference';
    public const SEARCH_RESULT_ERP_ORDER_ITEMS = 'erp_order_items';
    public const SEARCH_RESULT_BILLING_ADDRESS = 'billing_address';
    public const SEARCH_RESULT_SHIPPING_ADDRESS = 'shipping_address';
    public const SEARCH_RESULT_COMPANY_BUSINESS_UNIT = 'company_business_unit';
    public const SEARCH_RESULT_COMPANY_USER = 'company_user';

    public function __construct()
    {
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array
    {
        $searchData = [
            ErpOrderIndexMap::LOCALE => null,
            ErpOrderIndexMap::CONCRETE_DELIVERY_DATE => $this->getConcreteDeliveryDate($data[static::CONCRETE_DELIVERY_DATE]),
            ErpOrderIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpOrderIndexMap::ID_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpOrderIndexMap::COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            ErpOrderIndexMap::ID_COMPANY_USER => $data[static::FK_COMPANY_USER],
            ErpOrderIndexMap::COMPANY_USER_REFERENCE => $data[static::COMPANY_USER][static::COMPANY_USER_REFERENCE],
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
            static::SEARCH_RESULT_CONCRETE_DELIVERY_DATE => $this->getConcreteDeliveryDate($data[static::CONCRETE_DELIVERY_DATE]),
            static::SEARCH_RESULT_ID_ERP_ORDER => $data[static::ID_ERP_ORDER],
            static::SEARCH_RESULT_FK_BILLING_ADDRESS => $data[static::FK_BILLING_ADDRESS],
            static::SEARCH_RESULT_FK_SHIPPING_ADDRESS => $data[static::FK_SHIPPING_ADDRESS],
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_COMPANY_USER_REFERENCE => $data[static::COMPANY_USER][static::COMPANY_USER_REFERENCE],
            static::SEARCH_RESULT_FK_COMPANY_USER => $data[static::FK_COMPANY_USER],
            static::SEARCH_RESULT_REFERENCE => $data[static::REFERENCE],
            static::SEARCH_RESULT_COMPANY_USER => $data[static::COMPANY_USER],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT => $data[static::COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_ERP_ORDER_ITEMS => $data[static::ERP_ORDER_ITEMS],
            static::SEARCH_RESULT_SHIPPING_ADDRESS => $data[static::SHIPPING_ADDRESS],
            static::SEARCH_RESULT_BILLING_ADDRESS => $data[static::BILLING_ADDRESS],
        ];
    }

    /**
     * @param  string|null  $deliveryDate
     *
     * @return string|null
     * @throws \Exception
     */
    protected function getConcreteDeliveryDate(?string $deliveryDate): ?string
    {
        if ($deliveryDate !== null) {
            $deliveryDate = new DateTime($deliveryDate);
            $deliveryDate = $deliveryDate->format(ErpOrderConstants::CONCRETE_DELIVERY_DATE_FORMAT);
        }

        return $deliveryDate;
    }
}
