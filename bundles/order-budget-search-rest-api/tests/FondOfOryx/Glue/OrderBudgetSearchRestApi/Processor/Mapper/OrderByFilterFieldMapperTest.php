<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderByFilterFieldMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RequestParameterFilterInterface|MockObject $requestParameterFilterMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderByFilterFieldMapper
     */
    protected OrderByFilterFieldMapper $orderByFilterFieldMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameterFilterMock = $this->getMockBuilder(RequestParameterFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OrderBudgetSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderByFilterFieldMapper = new OrderByFilterFieldMapper(
            $this->requestParameterFilterMock,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $sortFields = ['foo', 'bar'];

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->with($this->restRequestMock, 'sort')
            ->willReturn('foo_asc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $filterFieldTransfer = $this->orderByFilterFieldMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY, $filterFieldTransfer->getType());
        static::assertEquals('foo::asc', $filterFieldTransfer->getValue());
    }

    /**
     * @return void
     */
    public function testFromRestRequestWithUndefinedSortField(): void
    {
        $sortFields = ['bar'];

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->with($this->restRequestMock, 'sort')
            ->willReturn('foo_asc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        static::assertEquals(
            null,
            $this->orderByFilterFieldMapper->fromRestRequest($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequestWithNullableSortParameter(): void
    {
        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->with($this->restRequestMock, 'sort')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getSortFields');

        static::assertEquals(
            null,
            $this->orderByFilterFieldMapper->fromRestRequest($this->restRequestMock),
        );
    }
}
