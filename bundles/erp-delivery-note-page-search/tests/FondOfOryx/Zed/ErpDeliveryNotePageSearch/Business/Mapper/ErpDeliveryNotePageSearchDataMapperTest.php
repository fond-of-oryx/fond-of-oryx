<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use Codeception\Test\Unit;

class ErpDeliveryNotePageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected $erpDeliveryNotePageSearchDataMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePageSearchDataMapper = new ErpDeliveryNotePageSearchDataMapper();
    }

    /**
     * @return void
     */
    public function testMapErpDeliveryNoteDataToSearchData(): void
    {
        $data = [
            ErpDeliveryNotePageSearchDataMapper::ORDER_DATE => 'now',
            ErpDeliveryNotePageSearchDataMapper::CREATED_AT => 'now',
            ErpDeliveryNotePageSearchDataMapper::UPDATED_AT => 'now',
            ErpDeliveryNotePageSearchDataMapper::DOCUMENT_NUMBER => '',
            ErpDeliveryNotePageSearchDataMapper::DELIVERY_NOTE_NUMBER => '',
            ErpDeliveryNotePageSearchDataMapper::EXTERNAL_REFERENCE => '',
            ErpDeliveryNotePageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => '',
            ErpDeliveryNotePageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpDeliveryNotePageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpDeliveryNotePageSearchDataMapper::ID_ERP_DELIVERY_NOTE => '',
            ErpDeliveryNotePageSearchDataMapper::FK_BILLING_ADDRESS => '',
            ErpDeliveryNotePageSearchDataMapper::FK_SHIPPING_ADDRESS => '',
            ErpDeliveryNotePageSearchDataMapper::ERP_DELIVERY_NOTE_ITEMS => [],
            ErpDeliveryNotePageSearchDataMapper::ERP_DELIVERY_NOTE_EXPENSES => [],
            ErpDeliveryNotePageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpDeliveryNotePageSearchDataMapper::BILLING_ADDRESS => null,
            ErpDeliveryNotePageSearchDataMapper::CURRENCY_ISO_CODE => '',
        ];

        $searchData = $this->erpDeliveryNotePageSearchDataMapper->mapErpDeliveryNoteDataToSearchData($data);

        $this->assertIsArray($searchData);
        $this->assertNotEmpty($searchData);
    }
}
