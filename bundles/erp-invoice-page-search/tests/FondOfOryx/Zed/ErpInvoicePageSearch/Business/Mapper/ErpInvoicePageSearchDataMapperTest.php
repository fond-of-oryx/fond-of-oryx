<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use Codeception\Test\Unit;

class ErpInvoicePageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface
     */
    protected $erpInvoicePageSearchDataMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePageSearchDataMapper = new ErpInvoicePageSearchDataMapper();
    }

    /**
     * @return void
     */
    public function testMapErpInvoiceDataToSearchData(): void
    {
        $data = [
            ErpInvoicePageSearchDataMapper::INVOICE_DATE => 'now',
            ErpInvoicePageSearchDataMapper::EXTERNAL_REFERENCE => '',
            ErpInvoicePageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => '',
            ErpInvoicePageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpInvoicePageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpInvoicePageSearchDataMapper::REFERENCE => '',
            ErpInvoicePageSearchDataMapper::ID_ERP_INVOICE => '',
            ErpInvoicePageSearchDataMapper::FK_BILLING_ADDRESS => '',
            ErpInvoicePageSearchDataMapper::FK_SHIPPING_ADDRESS => '',
            ErpInvoicePageSearchDataMapper::ERP_INVOICE_ITEMS => [],
            ErpInvoicePageSearchDataMapper::ERP_INVOICE_TOTAL => null,
            ErpInvoicePageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpInvoicePageSearchDataMapper::BILLING_ADDRESS => null,
            ErpInvoicePageSearchDataMapper::CURRENCY_ISO_CODE => '',
        ];

        $searchData = $this->erpInvoicePageSearchDataMapper->mapErpInvoiceDataToSearchData($data);

        $this->assertIsArray($searchData);
        $this->assertNotEmpty($searchData);
    }
}
