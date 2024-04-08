<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Search\ErpOrderIndexMap;

class ErpOrderPageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextBoostedMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface
     */
    protected $erpOrderPageSearchDataMapper;

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

        $this->erpOrderPageSearchDataMapper = new ErpOrderPageSearchDataMapper(
            $this->fullTextMapperMock,
            $this->fullTextBoostedMapperMock,
        );
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
            ErpOrderPageSearchDataMapper::EXTERNAL_REFERENCE => 'foo',
            ErpOrderPageSearchDataMapper::CUSTOM_REFERENCE => '',
            ErpOrderPageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => 1,
            ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpOrderPageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpOrderPageSearchDataMapper::ID_ERP_ORDER => 1,
            ErpOrderPageSearchDataMapper::FK_BILLING_ADDRESS => 1,
            ErpOrderPageSearchDataMapper::FK_SHIPPING_ADDRESS => 1,
            ErpOrderPageSearchDataMapper::FK_TOTALS => 1,
            ErpOrderPageSearchDataMapper::ITEMS => [],
            ErpOrderPageSearchDataMapper::ERP_ORDER_EXPENSES => [],
            ErpOrderPageSearchDataMapper::TOTALS => null,
            ErpOrderPageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::BILLING_ADDRESS => null,
            ErpOrderPageSearchDataMapper::CURRENCY_ISO_CODE => '',
            ErpOrderPageSearchDataMapper::OUTSTANDING_QUANTITY => 1,
            ErpOrderPageSearchDataMapper::IS_CANCELED => false,
            ErpOrderPageSearchDataMapper::PURCHASER_EMAIL => 'john.doe@example.com',
            ErpOrderPageSearchDataMapper::SEARCH_RESULT_PURCHASER_FIRST_NAME => 'john',
            ErpOrderPageSearchDataMapper::SEARCH_RESULT_PURCHASER_LAST_NAME => 'doe',
            ErpOrderPageSearchDataMapper::REFERENCE => 'ref',
        ];

        $fullText = [
            $data[ErpOrderPageSearchDataMapper::EXTERNAL_REFERENCE],
            $data[ErpOrderPageSearchDataMapper::CUSTOM_REFERENCE],
        ];

        $fullTextBoosted = [
            $data[ErpOrderPageSearchDataMapper::EXTERNAL_REFERENCE],
        ];

        $this->fullTextMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullText);

        $this->fullTextBoostedMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullTextBoosted);

        $searchData = $this->erpOrderPageSearchDataMapper->mapErpOrderDataToSearchData($data);

        static::assertNotEmpty($searchData);
        static::assertEquals($fullText, $searchData[ErpOrderIndexMap::FULL_TEXT]);
        static::assertEquals($fullTextBoosted, $searchData[ErpOrderIndexMap::FULL_TEXT_BOOSTED]);
    }
}
