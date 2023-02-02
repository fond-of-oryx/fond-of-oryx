<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;

class ErpDeliveryNotePageSearchDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\AbstractFullTextMapper|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fullTextBoostedMapperMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected $erpDeliveryNotePageSearchDataMapper;

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

        $this->erpDeliveryNotePageSearchDataMapper = new ErpDeliveryNotePageSearchDataMapper(
            $this->fullTextMapperMock,
            $this->fullTextBoostedMapperMock,
        );
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
            ErpDeliveryNotePageSearchDataMapper::EXTERNAL_REFERENCE => 'foo',
            ErpDeliveryNotePageSearchDataMapper::CUSTOM_REFERENCE => 'bar',
            ErpDeliveryNotePageSearchDataMapper::FK_COMPANY_BUSINESS_UNIT => 1,
            ErpDeliveryNotePageSearchDataMapper::COMPANY_BUSINESS_UNIT => [
                ErpDeliveryNotePageSearchDataMapper::COMPANY_BUSINESS_UNIT_UUID => '',
            ],
            ErpDeliveryNotePageSearchDataMapper::ID_ERP_DELIVERY_NOTE => 1,
            ErpDeliveryNotePageSearchDataMapper::FK_BILLING_ADDRESS => 1,
            ErpDeliveryNotePageSearchDataMapper::FK_SHIPPING_ADDRESS => 1,
            ErpDeliveryNotePageSearchDataMapper::ERP_DELIVERY_NOTE_ITEMS => [],
            ErpDeliveryNotePageSearchDataMapper::ERP_DELIVERY_NOTE_EXPENSES => [],
            ErpDeliveryNotePageSearchDataMapper::SHIPPING_ADDRESS => null,
            ErpDeliveryNotePageSearchDataMapper::BILLING_ADDRESS => null,
            ErpDeliveryNotePageSearchDataMapper::CURRENCY_ISO_CODE => '',
        ];

        $fullText = [
            $data[ErpDeliveryNotePageSearchDataMapper::EXTERNAL_REFERENCE],
            $data[ErpDeliveryNotePageSearchDataMapper::CUSTOM_REFERENCE],
        ];

        $fullTextBoosted = [
            $data[ErpDeliveryNotePageSearchDataMapper::EXTERNAL_REFERENCE],
        ];

        $this->fullTextMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullText);

        $this->fullTextBoostedMapperMock->expects(static::atLeastOnce())
            ->method('fromData')
            ->with($data)
            ->willReturn($fullTextBoosted);

        $searchData = $this->erpDeliveryNotePageSearchDataMapper->mapErpDeliveryNoteDataToSearchData($data);

        $this->assertNotEmpty($searchData);
        static::assertEquals($fullText, $searchData[ErpDeliveryNoteIndexMap::FULL_TEXT]);
        static::assertEquals($fullTextBoosted, $searchData[ErpDeliveryNoteIndexMap::FULL_TEXT_BOOSTED]);
    }
}
