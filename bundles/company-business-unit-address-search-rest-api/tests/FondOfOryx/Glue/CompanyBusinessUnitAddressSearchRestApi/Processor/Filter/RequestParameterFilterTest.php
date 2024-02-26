<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Expander\FilterExpanderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request|mixed
     */
    protected FilterExpanderInterface|MockObject $filterExpanderMock;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $inputBag;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilter
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

        $this->filterExpanderMock = $this->getMockBuilder(FilterExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock->query = new ParameterBag(['foo' => 'bar']);

        $this->requestParameterFilter = new RequestParameterFilter($this->filterExpanderMock);
    }

    /**
     * @return void
     */
    public function testGetRequestParameter(): void
    {
        $collection = new ArrayObject();

        $this->filterExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, $collection)
            ->willReturn($collection);

        static::assertEquals(
            $collection,
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock, $collection),
        );
    }

    /**
     * @return void
     */
    public function testGetRequestParameterWithNewCollection(): void
    {
        $this->filterExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturnCallback(static function (RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers) {
                return $filterFieldTransfers;
            });

        static::assertInstanceOf(
            ArrayObject::class,
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock),
        );
    }
}
