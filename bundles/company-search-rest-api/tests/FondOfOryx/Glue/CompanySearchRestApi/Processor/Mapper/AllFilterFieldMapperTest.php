<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class AllFilterFieldMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\AllFilterFieldMapper
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

        static::assertEquals(CompanySearchRestApiConstants::FILTER_FIELD_TYPE_ALL, $filterFieldTransfer->getType());
        static::assertEquals('foo', $filterFieldTransfer->getValue());
    }
}
