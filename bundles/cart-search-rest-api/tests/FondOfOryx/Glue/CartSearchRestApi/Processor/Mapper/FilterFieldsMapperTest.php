<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapperTest extends Unit
{
    /**
     * @var array<\FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldMapperInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldMapperMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapper
     */
    protected $filterFieldsMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldMapperMocks = [
            $this->getMockBuilder(FilterFieldMapperInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldMapperInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsMapper = new FilterFieldsMapper(
            $this->filterFieldMapperMocks,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $this->filterFieldMapperMocks[0]->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->filterFieldTransferMock);

        $this->filterFieldMapperMocks[1]->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(null);

        $filterFieldTransfers = $this->filterFieldsMapper->fromRestRequest($this->restRequestMock);

        static::assertCount(1, $filterFieldTransfers);
        static::assertContains($this->filterFieldTransferMock, $filterFieldTransfers);
    }
}
