<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapperTest extends Unit
{
    /**
     * @var array<(\FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldMapperMocks;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpanderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FilterFieldsExpanderInterface|MockObject $filterFieldsExpanderMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FilterFieldTransfer $filterFieldTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapper
     */
    protected FilterFieldsMapper $filterFieldsMapper;

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

        $this->filterFieldsExpanderMocks = $this->getMockBuilder(FilterFieldsExpanderInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsMapper = new FilterFieldsMapper(
            $this->filterFieldMapperMocks,
            $this->filterFieldsExpanderMocks,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $filterFieldTransferMock = $this->filterFieldTransferMock;
        $filterFieldTransferMocks = new ArrayObject([$filterFieldTransferMock]);

        $this->filterFieldMapperMocks[0]->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->filterFieldTransferMock);

        $this->filterFieldMapperMocks[1]->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(null);

        $this->filterFieldsExpanderMocks->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, static::callback(
                static function (ArrayObject $filterFieldTransfers) use ($filterFieldTransferMock) {
                    return $filterFieldTransfers->count() === 1
                        && $filterFieldTransfers->offsetGet(0) === $filterFieldTransferMock;
                },
            ))->willReturn($filterFieldTransferMocks);

        static::assertEquals(
            $filterFieldTransferMocks,
            $this->filterFieldsMapper->fromRestRequest($this->restRequestMock),
        );
    }
}
