<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpOrderPageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpOrderPageSearchPaginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchPaginationSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpOrderPageSearchPaginationSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface
     */
    protected $restErpOrderPageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpOrderPageSearchPaginationMapperMock = $this->getMockBuilder(RestErpOrderPageSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchPaginationSortMapperMock = $this->getMockBuilder(RestErpOrderPageSearchPaginationSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchCollectionResponseMapper = new RestErpOrderPageSearchCollectionResponseMapper(
            $this->restErpOrderPageSearchPaginationMapperMock,
            $this->restErpOrderPageSearchPaginationSortMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testMapErpOrderResource(): void
    {
        $data = [
            'erp-orders' => [
                0 => [
                    'items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_order_total' => [
                        0 => ['subtotal' => 1000],
                        1 => ['grandTotal' => 1990],
                        2 => ['taxTotal' => 190],
                    ],
                    'totals' => [
                        0 => ['subtotal' => 1000],
                        1 => ['grandTotal' => 1990],
                        2 => ['taxTotal' => 190],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];

        $this->restErpOrderPageSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $this->restErpOrderPageSearchPaginationSortMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $transfer = $this->restErpOrderPageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpOrders()[0]->getItems()[0]->getSku());
        static::assertCount(count($data['erp-orders'][0]['items']), $transfer->getErpOrders()[0]->getItems());
    }
}
