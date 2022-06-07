<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class AllFilterFieldMapperTest extends Unit
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
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\AllFilterFieldMapper
     */
    protected $allFilterFieldMapper;

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

        static::assertEquals('all', $filterFieldTransfer->getType());
        static::assertEquals('foo', $filterFieldTransfer->getValue());
    }
}
