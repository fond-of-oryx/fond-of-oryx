<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Filter;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class RequestParameterFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request|mixed
     */
    protected $httpRequestMock;

    /**
     * @var \Symfony\Component\HttpFoundation\InputBag
     */
    protected $inputBag;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\RequestParameterFilter
     */
    protected $requestParameterFilter;

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
