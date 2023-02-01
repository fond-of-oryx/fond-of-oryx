<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Builder\RequestBuilder;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapper;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ErpOrderPageSearchReaderTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface
     */
    protected $metadataMock;

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
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator\RestErpOrderPageSearchCollectionResponseTranslatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpOrderPageSearchCollectionResponseTranslatorMock;

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
    protected $restErpOrderPageSearchCollectionResponseTransferMock;

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

        $this->metadataMock = $this->getMockBuilder(MetadataInterface::class)
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
            ->getMockBuilder(RestErpOrderPageSearchCollectionResponseMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpOrderPageSearchCollectionResponseTranslatorMock = $this
            ->getMockBuilder(RestErpOrderPageSearchCollectionResponseTranslatorInterface::class)
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

        $this->restErpOrderPageSearchCollectionResponseTransferMock = $this
            ->getMockBuilder(RestErpOrderPageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpOrderPageSearchReader(
            $this->erpOrderPageSearchClient,
            $this->requestBuilderMock,
            $this->erpOrderMapperMock,
            $this->restErpOrderPageSearchCollectionResponseTranslatorMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpOrdersByFilterTransfer(): void
    {
        $searchString = 'foo';
        $requestParams = [];
        $searchResult = [];
        $locale = 'de_DE';

        $this->requestBuilderMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->erpOrderPageSearchRequestTransferMock);

        $this->erpOrderPageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getSearchString')
            ->willReturn($searchString);

        $this->erpOrderPageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getRequestParams')
            ->willReturn($requestParams);

        $this->erpOrderPageSearchClient->expects(static::atLeastOnce())
            ->method('search')
            ->with($searchString, $requestParams)
            ->willReturn($searchResult);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->erpOrderMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($searchResult)
            ->willReturn($this->restErpOrderPageSearchCollectionResponseTransferMock);

        $this->restErpOrderPageSearchCollectionResponseTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restErpOrderPageSearchCollectionResponseTransferMock, $locale)
            ->willReturn($this->restErpOrderPageSearchCollectionResponseTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDERS,
                null,
                $this->restErpOrderPageSearchCollectionResponseTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->reader->findErpOrdersByFilterTransfer($this->restRequestMock),
        );
    }
}
