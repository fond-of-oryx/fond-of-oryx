<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpDeliveryNotePageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpDeliveryNotePageSearchPaginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpDeliveryNotePageSearchPaginationSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpDeliveryNotePageSearchPaginationMapperMock = $this->getMockBuilder(RestErpDeliveryNotePageSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchPaginationSortMapperMock = $this->getMockBuilder(RestErpDeliveryNotePageSearchPaginationSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchCollectionResponseMapper = new RestErpDeliveryNotePageSearchCollectionResponseMapper(
            $this->restErpDeliveryNotePageSearchPaginationMapperMock,
            $this->restErpDeliveryNotePageSearchPaginationSortMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testMapErpDeliveryNoteResource(): void
    {
        $data = [
            'erp-delivery-notes' => [
                0 => [
                    'erp_delivery_note_items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_delivery_note_expenses' => [
                        0 => ['name' => 'name'],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];

        $this->restErpDeliveryNotePageSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $this->restErpDeliveryNotePageSearchPaginationSortMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $transfer = $this->restErpDeliveryNotePageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpDeliveryNotes()[0]->getItems()[0]->getSku());
    }
}
