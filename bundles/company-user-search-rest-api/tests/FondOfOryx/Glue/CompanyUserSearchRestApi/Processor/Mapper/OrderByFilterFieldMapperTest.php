<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderByFilterFieldMapperTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig
     */
    protected MockObject|CompanyUserSearchRestApiConfig $configMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\OrderByFilterFieldMapper
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

        $this->configMock = $this->getMockBuilder(CompanyUserSearchRestApiConfig::class)
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

        static::assertEquals(CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_ORDER_BY, $filterFieldTransfer->getType());
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
