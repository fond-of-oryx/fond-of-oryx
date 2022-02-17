<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridge;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapper;
use Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ErpDeliveryNotePageSearchReaderTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNotePageSearchRequestTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNotePageSearchClient;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestBuilderMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteMapperMock;

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
     * @var \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface
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

        $this->erpDeliveryNotePageSearchRequestTransferMock = $this
            ->getMockBuilder(ErpDeliveryNotePageSearchRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchClient = $this
            ->getMockBuilder(ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteMapperMock = $this
            ->getMockBuilder(ErpDeliveryNoteMapper::class)
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

        $this->erpDeliveryNoteTransferMock = $this
            ->getMockBuilder(RestErpDeliveryNotePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNotePageSearchReader(
            $this->erpDeliveryNotePageSearchClient,
            $this->requestBuilderMock,
            $this->erpDeliveryNoteMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNotesByFilterTransfer(): void
    {
        $this->requestBuilderMock->expects($this->once())->method('create')->willReturn($this->erpDeliveryNotePageSearchRequestTransferMock);
        $this->erpDeliveryNotePageSearchRequestTransferMock->expects($this->once())->method('getSearchString')->willReturn('');
        $this->erpDeliveryNotePageSearchRequestTransferMock->expects($this->once())->method('getRequestParams')->willReturn([]);
        $this->erpDeliveryNotePageSearchClient->expects($this->once())->method('search')->willReturn([]);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResponse')->willReturn($this->restResponseMock);
        $this->restResourceBuilderMock->expects($this->once())->method('createRestResource')->willReturn($this->restResourceMock);
        $this->erpDeliveryNoteMapperMock->expects($this->once())->method('mapErpDeliveryNoteResource')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->restResponseMock->expects($this->once())->method('addResource')->willReturn($this->restResponseMock);

        $response = $this->reader->findErpDeliveryNotesByFilterTransfer($this->restRequestMock);

        $this->assertInstanceOf(RestResponseInterface::class, $response);
    }
}
