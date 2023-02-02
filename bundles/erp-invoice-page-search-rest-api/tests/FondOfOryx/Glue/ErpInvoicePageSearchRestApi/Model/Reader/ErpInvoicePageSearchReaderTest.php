<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface;
use Generated\Shared\Transfer\ErpInvoicePageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpInvoicePageSearchReaderTest extends Unit
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
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpInvoicePageSearchCollectionResponseMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator\RestErpInvoicePageSearchCollectionResponseTranslatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpInvoicePageSearchCollectionResponseTranslatorMock;

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
    protected $restErpInvoicePageSearchCollectionResponseTransferMock;

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
            ->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataMock = $this
            ->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchRequestTransferMock = $this
            ->getMockBuilder(ErpInvoicePageSearchRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchClient = $this
            ->getMockBuilder(ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchCollectionResponseMapperMock = $this
            ->getMockBuilder(RestErpInvoicePageSearchCollectionResponseMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchCollectionResponseTranslatorMock = $this
            ->getMockBuilder(RestErpInvoicePageSearchCollectionResponseTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestBuilderMock = $this
            ->getMockBuilder(RequestBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this
            ->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this
            ->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this
            ->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpInvoicePageSearchCollectionResponseTransferMock = $this
            ->getMockBuilder(RestErpInvoicePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpInvoicePageSearchReader(
            $this->erpInvoicePageSearchClient,
            $this->requestBuilderMock,
            $this->restErpInvoicePageSearchCollectionResponseMapperMock,
            $this->restErpInvoicePageSearchCollectionResponseTranslatorMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpInvoicesByFilterTransfer(): void
    {
        $searchString = 'foo';
        $requestParams = [];
        $searchResult = [];
        $locale = 'de_DE';

        $this->requestBuilderMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->erpInvoicePageSearchRequestTransferMock);

        $this->erpInvoicePageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getSearchString')
            ->willReturn($searchString);

        $this->erpInvoicePageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getRequestParams')
            ->willReturn($requestParams);

        $this->erpInvoicePageSearchClient->expects(static::atLeastOnce())
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

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceMock);

        $this->restErpInvoicePageSearchCollectionResponseMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($searchResult)
            ->willReturn($this->restErpInvoicePageSearchCollectionResponseTransferMock);

        $this->restErpInvoicePageSearchCollectionResponseTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restErpInvoicePageSearchCollectionResponseTransferMock, $locale)
            ->willReturn($this->restErpInvoicePageSearchCollectionResponseTransferMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->reader->findErpInvoicesByFilterTransfer($this->restRequestMock),
        );
    }
}
