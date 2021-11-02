<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapper;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ErpOrderPageSearchReaderTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPageSearchRequestTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestBuilderMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderMapperMock;

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
     * @var \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface
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

        $this->erpOrderPageSearchRequestTransferMock = $this
            ->getMockBuilder(ErpOrderPageSearchRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchClient = $this
            ->getMockBuilder(ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderMapperMock = $this
            ->getMockBuilder(ErpOrderMapper::class)
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

        $this->erpOrderTransferMock = $this
            ->getMockBuilder(RestErpOrderPageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderPageSearchReader(
            $this->erpOrderPageSearchClient,
            $this->requestBuilderMock,
            $this->erpOrderMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpOrdersByFilterTransfer(): void
    {
        $this->requestBuilderMock->expects($this->once())->method('create')->willReturn($this->erpOrderPageSearchRequestTransferMock);
        $this->erpOrderPageSearchRequestTransferMock->expects($this->once())->method('getSearchString')->willReturn('');
        $this->erpOrderPageSearchRequestTransferMock->expects($this->once())->method('getRequestParams')->willReturn([]);
        $this->erpOrderPageSearchClient->expects($this->once())->method('search')->willReturn([]);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResponse')->willReturn($this->restResponseMock);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResource')->willReturn($this->restResourceMock);
        $this->erpOrderMapperMock->expects($this->once())->method('mapErpOrderResource')->willReturn($this->erpOrderTransferMock);
        $this->restResponseMock->expects($this->once())->method('addResource')->willReturn($this->restResponseMock);

        $response = $this->reader->findErpOrdersByFilterTransfer($this->restRequestMock);

        $this->assertInstanceOf(RestResponseInterface::class, $response);
    }
}
