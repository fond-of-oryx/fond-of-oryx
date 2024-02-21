<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Expander\FilterExpanderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
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

    protected FilterExpanderInterface|MockObject $filterExpanderMock;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $inputBag;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilter
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

        $this->filterExpanderMock = $this->getMockBuilder(FilterExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameterFilter = new RequestParameterFilter($this->filterExpanderMock);
    }

    /**
     * @return void
     */
    public function testGetRequestParameter(): void
    {
        $filterCollection = new ArrayObject();

        $this->filterExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturn($filterCollection);

        static::assertEquals(
            $filterCollection,
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock, $filterCollection),
        );
    }

    /**
     * @return void
     */
    public function testGetRequestParameterWithNonExistingName(): void
    {
        $this->filterExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturnCallback(static function (RestRequestInterface $restRequestMock, ArrayObject $arrayObject) {
                return $arrayObject;
            });

        static::assertInstanceOf(
            ArrayObject::class,
            $this->requestParameterFilter->getRequestParameter($this->restRequestMock),
        );
    }
}
