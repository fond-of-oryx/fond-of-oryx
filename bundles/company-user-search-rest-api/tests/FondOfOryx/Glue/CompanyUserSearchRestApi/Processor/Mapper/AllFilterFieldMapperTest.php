<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class AllFilterFieldMapperTest extends Unit
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
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\AllFilterFieldMapper
     */
    protected AllFilterFieldMapper $allFilterFieldMapper;

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

        $this->allFilterFieldMapper = new AllFilterFieldMapper(
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
            ->with($this->restRequestMock, 'q')
            ->willReturn('foo');

        $filterFieldTransfer = $this->allFilterFieldMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_ALL, $filterFieldTransfer->getType());
        static::assertEquals('foo', $filterFieldTransfer->getValue());
    }
}
