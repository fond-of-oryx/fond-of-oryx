<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use DateTime;
use FondOfOryx\Shared\ErpDeliveryNote\ErpDeliveryNoteConstants;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;

class ErpDeliveryNotePageSearchDataMapper implements ErpDeliveryNotePageSearchDataMapperInterface
{
    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT = ErpDeliveryNotePageSearchPublisher::COMPANY_BUSINESS_UNIT;

    /**
     * @var string
     */
    public const ERP_DELIVERY_NOTE_ITEMS = ErpDeliveryNotePageSearchPublisher::ERP_DELIVERY_NOTE_ITEMS;

    /**
     * @var string
     */
    public const ERP_DELIVERY_NOTE_EXPENSES = ErpDeliveryNotePageSearchPublisher::ERP_DELIVERY_NOTE_EXPENSES;

    /**
     * @var string
     */
    public const BILLING_ADDRESS = ErpDeliveryNotePageSearchPublisher::BILLING_ADDRESS;

    /**
     * @var string
     */
    public const SHIPPING_ADDRESS = ErpDeliveryNotePageSearchPublisher::SHIPPING_ADDRESS;

    /**
     * @var string
     */
    public const ID_ERP_DELIVERY_NOTE = 'id_erp_delivery_note';

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
    public const ORDER_DATE = 'order_date';

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
    public const SEARCH_RESULT_ORDER_DATE = 'order_date';

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
    public const SEARCH_RESULT_ID_ERP_DELIVERY_NOTE = 'id_erp_delivery_note';

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
    public const SEARCH_RESULT_ERP_DELIVERY_NOTE_ITEMS = 'erp_delivery_note_items';

    /**
     * @var string
     */
    public const SEARCH_RESULT_ERP_DELIVERY_NOTE_EXPENSES = 'erp_delivery_note_expenses';

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
    public function mapErpDeliveryNoteDataToSearchData(array $data): array
    {
        $searchData = [
            ErpDeliveryNoteIndexMap::LOCALE => null,
            ErpDeliveryNoteIndexMap::ORDER_DATE => $this->convertDate($data[static::ORDER_DATE]),
            ErpDeliveryNoteIndexMap::CREATED_AT => $this->convertDate($data[static::CREATED_AT]),
            ErpDeliveryNoteIndexMap::UPDATED_AT => $this->convertDate($data[static::UPDATED_AT]),
            ErpDeliveryNoteIndexMap::DOCUMENT_NUMBER => $data[static::DOCUMENT_NUMBER],
            ErpDeliveryNoteIndexMap::EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            ErpDeliveryNoteIndexMap::ID_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            ErpDeliveryNoteIndexMap::COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            ErpDeliveryNoteIndexMap::SEARCH_RESULT_DATA => $this->mapErpDeliveryNoteDataToSearchResultData($data),
        ];

        return $searchData;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapErpDeliveryNoteDataToSearchResultData(array $data): array
    {
        return [
            static::SEARCH_RESULT_ORDER_DATE => $this->convertDate($data[static::ORDER_DATE]),
            static::SEARCH_RESULT_CREATED_AT => $this->convertDate($data[static::CREATED_AT]),
            static::SEARCH_RESULT_UPDATED_AT => $this->convertDate($data[static::UPDATED_AT]),
            static::SEARCH_RESULT_DOCUMENT_NUMBER => $data[static::DOCUMENT_NUMBER],
            static::SEARCH_RESULT_ID_ERP_DELIVERY_NOTE => $data[static::ID_ERP_DELIVERY_NOTE],
            static::SEARCH_RESULT_FK_BILLING_ADDRESS => $data[static::FK_BILLING_ADDRESS],
            static::SEARCH_RESULT_FK_SHIPPING_ADDRESS => $data[static::FK_SHIPPING_ADDRESS],
            static::SEARCH_RESULT_FK_COMPANY_BUSINESS_UNIT => $data[static::FK_COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT_UUID => $data[static::COMPANY_BUSINESS_UNIT][static::COMPANY_BUSINESS_UNIT_UUID],
            static::SEARCH_RESULT_EXTERNAL_REFERENCE => $data[static::EXTERNAL_REFERENCE],
            static::SEARCH_RESULT_COMPANY_BUSINESS_UNIT => $data[static::COMPANY_BUSINESS_UNIT],
            static::SEARCH_RESULT_ERP_DELIVERY_NOTE_ITEMS => $data[static::ERP_DELIVERY_NOTE_ITEMS],
            static::SEARCH_RESULT_ERP_DELIVERY_NOTE_EXPENSES => $data[static::ERP_DELIVERY_NOTE_EXPENSES],
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
            return $this->dateToString(new DateTime($dateString));
        }

        return $dateString;
    }

    /**
     * @param \DateTime|null $dateTime
     *
     * @return string|null
     */
    protected function dateToString(?DateTime $dateTime): ?string
    {
        if ($dateTime === null) {
            return null;
        }

        return $dateTime->format(ErpDeliveryNoteConstants::DELIVERY_NOTE_DATE_FORMAT);
    }
}
