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
            ErpOrderPageSearchDataMapper::EXTERNAL_REFERENCE => '',
            ErpOrderPageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => '',
            ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpOrderPageSearchDataMapper::REFERENCE => '',
            ErpOrderPageSearchDataMapper::ID_ERP_ORDER => '',
            ErpOrderPageSearchDataMapper::FK_BILLING_ADDRESS => '',
            ErpOrderPageSearchDataMapper::FK_SHIPPING_ADDRESS => '',
            ErpOrderPageSearchDataMapper::ERP_ORDER_ITEMS => [],
            ErpOrderPageSearchDataMapper::ERP_ORDER_TOTAL => null,
            ErpOrderPageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::BILLING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::CURRENCY_ISO_CODE => '',
            ErpOrderPageSearchDataMapper::OUTSTANDING_QUANTITY => 1,
            ErpOrderPageSearchDataMapper::ERP_INVOICES => [],
            ErpOrderPageSearchDataMapper::CART_NOTE => '',
        ];

        $searchData = $this->erpOrderPageSearchDataMapper->mapErpOrderDataToSearchData($data);

        $this->assertIsArray($searchData);
        $this->assertNotEmpty($searchData);
    }
}
