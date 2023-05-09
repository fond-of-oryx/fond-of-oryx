<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class RequestParameterFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Symfony\Component\HttpFoundation\Request&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|Request $httpRequestMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\RequestParameterFilter
     */
    protected RequestParameterFilter $requestParameterFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock->query = new InputBag(['foo' => 'bar']);

        $this->requestParameterFilter = new RequestParameterFilter();
    }

    /**
     * @return void
     */
    public function testGetRequestParameter(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        static::assertEquals(
            'bar',
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock, 'foo'),
        );
    }

    /**
     * @return void
     */
    public function testGetRequestParameterWithNonExistingName(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        static::assertEquals(
            null,
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock, 'bar'),
        );
    }
}
