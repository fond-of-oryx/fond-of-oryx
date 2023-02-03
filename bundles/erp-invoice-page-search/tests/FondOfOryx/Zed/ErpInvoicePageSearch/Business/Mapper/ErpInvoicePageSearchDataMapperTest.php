<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Search\ErpInvoiceIndexMap;

class ErpInvoicePageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextBoostedMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface
     */
    protected $erpInvoicePageSearchDataMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->fullTextMapperMock = $this->getMockBuilder(AbstractFullTextMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fullTextBoostedMapperMock = $this->getMockBuilder(AbstractFullTextMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchDataMapper = new ErpInvoicePageSearchDataMapper(
            $this->fullTextMapperMock,
            $this->fullTextBoostedMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testMapErpInvoiceDataToSearchData(): void
    {
        $data = [
            ErpInvoicePageSearchDataMapper::INVOICE_DATE => 'now',
            ErpInvoicePageSearchDataMapper::CREATED_AT => 'now',
            ErpInvoicePageSearchDataMapper::UPDATED_AT => 'now',
            ErpInvoicePageSearchDataMapper::DOCUMENT_NUMBER => '',
            ErpInvoicePageSearchDataMapper::EXTERNAL_REFERENCE => 'foo',
            ErpInvoicePageSearchDataMapper::CUSTOM_REFERENCE => 'bar',
            ErpInvoicePageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => 1,
            ErpInvoicePageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpInvoicePageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpInvoicePageSearchDataMapper::ID_ERP_INVOICE => 1,
            ErpInvoicePageSearchDataMapper::FK_BILLING_ADDRESS => 1,
            ErpInvoicePageSearchDataMapper::FK_SHIPPING_ADDRESS => 1,
            ErpInvoicePageSearchDataMapper::ERP_INVOICE_ITEMS => [],
            ErpInvoicePageSearchDataMapper::ERP_INVOICE_EXPENSES => [],
            ErpInvoicePageSearchDataMapper::ERP_INVOICE_TOTAL => null,
            ErpInvoicePageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpInvoicePageSearchDataMapper::BILLING_ADDRESS => null,
            ErpInvoicePageSearchDataMapper::CURRENCY_ISO_CODE => '',
        ];

        $fullText = [
            $data[ErpInvoicePageSearchDataMapper::EXTERNAL_REFERENCE],
            $data[ErpInvoicePageSearchDataMapper::CUSTOM_REFERENCE],
        ];

        $fullTextBoosted = [
            $data[ErpInvoicePageSearchDataMapper::EXTERNAL_REFERENCE],
        ];

        $this->fullTextMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullText);

        $this->fullTextBoostedMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullTextBoosted);

        $searchData = $this->erpInvoicePageSearchDataMapper->mapErpInvoiceDataToSearchData($data);

        $this->assertNotEmpty($searchData);
        static::assertEquals($fullText, $searchData[ErpInvoiceIndexMap::FULL_TEXT]);
        static::assertEquals($fullTextBoosted, $searchData[ErpInvoiceIndexMap::FULL_TEXT_BOOSTED]);
    }
}
