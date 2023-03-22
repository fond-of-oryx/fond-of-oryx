<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpInvoicePageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpInvoicePageSearchPaginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchPaginationSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpInvoicePageSearchPaginationSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface
     */
    protected $restErpInvoicePageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpInvoicePageSearchPaginationMapperMock = $this->getMockBuilder(RestErpInvoicePageSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchPaginationSortMapperMock = $this->getMockBuilder(RestErpInvoicePageSearchPaginationSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchCollectionResponseMapper = new RestErpInvoicePageSearchCollectionResponseMapper(
            $this->restErpInvoicePageSearchPaginationMapperMock,
            $this->restErpInvoicePageSearchPaginationSortMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testMapErpInvoiceResource(): void
    {
        $data = [
            'erp-invoices' => [
                0 => [
                    'erp_invoice_items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_invoice_expenses' => [
                        0 => ['name' => 'name'],
                    ],
                    'erp_invoice_total' => [
                        0 => ['value' => 1000],
                        2 => ['tax' => 190],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];

        $this->restErpInvoicePageSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $this->restErpInvoicePageSearchPaginationSortMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($data)
            ->willReturn(null);

        $transfer = $this->restErpInvoicePageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpInvoices()[0]->getItems()[0]->getSku());
    }
}
