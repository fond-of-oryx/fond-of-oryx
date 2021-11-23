<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\Filter;
use Spryker\Glue\GlueApplication\Rest\Request\Data\Page;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class RequestBuilderTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\FilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pageMock;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $parameterBagMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->restRequestMock = $this
            ->getMockBuilder(RestRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterMock = $this
            ->getMockBuilder(Filter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMock = $this
            ->getMockBuilder(Page::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->parameterBagMock = $this
            ->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestBuilder = new RequestBuilder();
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->filterMock->expects($this->atLeastOnce())->method('getResource')->willReturn('test');
        $this->filterMock->expects($this->atLeastOnce())->method('getValue')->willReturn('value');
        $this->filterMock->expects($this->atLeastOnce())->method('getField')->willReturn('right');
        $this->requestMock->query = $this->parameterBagMock;
        $this->restRequestMock->expects($this->once())->method('getPage');
        $this->parameterBagMock->expects($this->once())->method('get')->willReturn(ErpInvoicePageSearchRestApiConfig::QUERY_STRING_PARAMETER);
        $this->parameterBagMock->expects($this->once())->method('all')->willReturn(['all params']);
        $this->restRequestMock->expects($this->once())->method('getInclude')->willReturn([]);
        $this->restRequestMock->expects($this->once())->method('getFilters')->willReturn(['test' => $this->filterMock]);
        $this->restRequestMock->expects($this->atLeastOnce())->method('getHttpRequest')->willReturn($this->requestMock);

        $transfer = $this->requestBuilder->create($this->restRequestMock);

        $this->assertSame([], $transfer->getIncludes());
        $this->assertIsArray($transfer->getFilters());
        $this->assertSame(ErpInvoicePageSearchRestApiConfig::QUERY_STRING_PARAMETER, $transfer->getSearchString());
        $this->assertSame(['all params'], $transfer->getRequestParams());
    }

    /**
     * @return void
     */
    public function testCreateWithPagination(): void
    {
        $this->filterMock->expects($this->atLeastOnce())->method('getResource')->willReturn('test');
        $this->filterMock->expects($this->atLeastOnce())->method('getValue')->willReturn('value');
        $this->filterMock->expects($this->atLeastOnce())->method('getField')->willReturn('right');
        $this->requestMock->query = $this->parameterBagMock;
        $this->restRequestMock->expects($this->exactly(4))->method('getPage')->willReturn($this->pageMock);
        $this->parameterBagMock->expects($this->once())->method('get')->willReturn(ErpInvoicePageSearchRestApiConfig::QUERY_STRING_PARAMETER);
        $this->parameterBagMock->expects($this->once())->method('all')->willReturn(['all params']);
        $this->pageMock->expects($this->atLeastOnce())->method('getLimit')->willReturn(1);
        $this->pageMock->expects($this->atLeastOnce())->method('getOffset')->willReturn(1);
        $this->restRequestMock->expects($this->once())->method('getInclude')->willReturn([]);
        $this->restRequestMock->expects($this->once())->method('getFilters')->willReturn(['test' => $this->filterMock]);
        $this->restRequestMock->expects($this->atLeastOnce())->method('getHttpRequest')->willReturn($this->requestMock);

        $transfer = $this->requestBuilder->create($this->restRequestMock);

        $this->assertSame([], $transfer->getIncludes());
        $this->assertIsArray($transfer->getFilters());
        $this->assertSame(ErpInvoicePageSearchRestApiConfig::QUERY_STRING_PARAMETER, $transfer->getSearchString());
        $this->assertArrayHasKey(ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE, $transfer->getRequestParams());
        $this->assertArrayHasKey(ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_PAGE, $transfer->getRequestParams());
        $this->assertEquals(1, $transfer->getRequestParams()[ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_ITEMS_PER_PAGE]);
        $this->assertEquals(2, $transfer->getRequestParams()[ErpInvoicePageSearchRestApiConfig::PARAMETER_NAME_PAGE]);
    }
}
