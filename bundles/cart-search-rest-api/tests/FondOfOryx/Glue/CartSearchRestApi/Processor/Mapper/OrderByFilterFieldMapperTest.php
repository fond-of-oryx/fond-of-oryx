<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderByFilterFieldMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\OrderByFilterFieldMapper
     */
    protected $orderByFilterFieldMapper;

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

        $this->configMock = $this->getMockBuilder(CartSearchRestApiConfig::class)
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

        static::assertEquals('orderBy', $filterFieldTransfer->getType());
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
