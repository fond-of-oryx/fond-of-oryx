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

    /**
     * @return void
     */
    public function testAddRestErpDeliveryNoteTracking(): void
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
                    'erp_delivery_note_tracking' => json_decode('
                    [
  {
    "tracking_number": "1234567",
    "shipping_agent_code": "DPD",
    "tracking_url": "https:\/\/tracking.dpd.de\/parcelstatus?query=1234567&locale=de_DE",
    "items": [
      {
        "quantity": 2,
        "sku": "00649-900Y0-10"
      }
    ]
  },
  {
    "tracking_number": "1234568",
    "shipping_agent_code": "DPD",
    "tracking_url": "https:\/\/tracking.dpd.de\/parcelstatus?query=1234568&locale=de_DE",
    "items": [
      {
        "quantity": 1,
        "sku": "00649-900Y0-10"
      },
      {
        "quantity": 1,
        "sku": "00649-90108-10"
      }
    ]
  }
]
                    ', true),
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

        static::assertEquals('1234567', $transfer->getErpDeliveryNotes()[0]->getTracking()[0]->getTrackingNumber());
        static::assertEquals(2, $transfer->getErpDeliveryNotes()[0]->getTracking()[0]->getQuantity());
        static::assertCount(2, $transfer->getErpDeliveryNotes()[0]->getTracking()[0]->getItems());
        static::assertEquals('1234568', $transfer->getErpDeliveryNotes()[0]->getTracking()[1]->getTrackingNumber());
        static::assertEquals(2, $transfer->getErpDeliveryNotes()[0]->getTracking()[1]->getQuantity());
    }
}
