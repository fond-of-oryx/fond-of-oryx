<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapper;
use Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ErpInvoicePageSearchReaderTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoicePageSearchRequestTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoicePageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestBuilderMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceMapperMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader\ErpInvoicePageSearchReaderInterface
     */
    protected $reader;

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

        $this->erpInvoicePageSearchRequestTransferMock = $this
            ->getMockBuilder(ErpInvoicePageSearchRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchClient = $this
            ->getMockBuilder(ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceMapperMock = $this
            ->getMockBuilder(ErpInvoiceMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestBuilderMock = $this
            ->getMockBuilder(RequestBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this
            ->getMockBuilder(RestResourceBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this
            ->getMockBuilder(RestResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this
            ->getMockBuilder(RestResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this
            ->getMockBuilder(RestErpInvoicePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoicePageSearchReader(
            $this->erpInvoicePageSearchClient,
            $this->requestBuilderMock,
            $this->erpInvoiceMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpInvoicesByFilterTransfer(): void
    {
        $this->requestBuilderMock->expects($this->once())->method('create')->willReturn($this->erpInvoicePageSearchRequestTransferMock);
        $this->erpInvoicePageSearchRequestTransferMock->expects($this->once())->method('getSearchString')->willReturn('');
        $this->erpInvoicePageSearchRequestTransferMock->expects($this->once())->method('getRequestParams')->willReturn([]);
        $this->erpInvoicePageSearchClient->expects($this->once())->method('search')->willReturn([]);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResponse')->willReturn($this->restResponseMock);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResource')->willReturn($this->restResourceMock);
        $this->erpInvoiceMapperMock->expects($this->once())->method('mapErpInvoiceResource')->willReturn($this->erpInvoiceTransferMock);
        $this->restResponseMock->expects($this->once())->method('addResource')->willReturn($this->restResponseMock);

        $response = $this->reader->findErpInvoicesByFilterTransfer($this->restRequestMock);

        $this->assertInstanceOf(RestResponseInterface::class, $response);
    }
}
