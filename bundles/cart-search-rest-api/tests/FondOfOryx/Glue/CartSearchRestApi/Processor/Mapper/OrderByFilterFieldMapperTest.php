<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
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

        $this->orderByFilterFieldMapper = new OrderByFilterFieldMapper(
            $this->requestParameterFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->with($this->restRequestMock, 'sort')
            ->willReturn('foo_asc');

        $filterFieldTransfer = $this->orderByFilterFieldMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals('orderBy', $filterFieldTransfer->getType());
        static::assertEquals('foo::asc', $filterFieldTransfer->getValue());
    }
}
