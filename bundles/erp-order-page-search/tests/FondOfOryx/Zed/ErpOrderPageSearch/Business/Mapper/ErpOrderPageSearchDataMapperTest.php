<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use Codeception\Test\Unit;

class ErpOrderPageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface
     */
    protected $erpOrderPageSearchDataMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPageSearchDataMapper = new ErpOrderPageSearchDataMapper();
    }

    /**
     * @return void
     */
    public function testMapErpOrderDataToSearchData(): void
    {
        $data = [
            ErpOrderPageSearchDataMapper::CONCRETE_DELIVERY_DATE => 'now',
            ErpOrderPageSearchDataMapper::CREATED_AT => 'now',
            ErpOrderPageSearchDataMapper::UPDATED_AT => 'now',
            ErpOrderPageSearchDataMapper::EXTERNAL_REFERENCE => '',
            ErpOrderPageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => '',
            ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpOrderPageSearchDataMapper::ID_ERP_ORDER => '',
            ErpOrderPageSearchDataMapper::FK_BILLING_ADDRESS => '',
            ErpOrderPageSearchDataMapper::FK_SHIPPING_ADDRESS => '',
            ErpOrderPageSearchDataMapper::FK_TOTALS => '',
            ErpOrderPageSearchDataMapper::ITEMS => [],
            ErpOrderPageSearchDataMapper::TOTALS => null,
            ErpOrderPageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::BILLING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::CURRENCY_ISO_CODE => '',
            ErpOrderPageSearchDataMapper::OUTSTANDING_QUANTITY => 1,
        ];

        $searchData = $this->erpOrderPageSearchDataMapper->mapErpOrderDataToSearchData($data);

        static::assertIsArray($searchData);
        static::assertNotEmpty($searchData);
    }
}
