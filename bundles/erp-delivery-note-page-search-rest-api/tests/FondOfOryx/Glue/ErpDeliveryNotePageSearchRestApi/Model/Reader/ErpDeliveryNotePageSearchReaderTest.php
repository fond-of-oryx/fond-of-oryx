<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Builder\RequestBuilderInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface;
use Generated\Shared\Transfer\ErpDeliveryNotePageSearchRequestTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ErpDeliveryNotePageSearchReaderTest extends Unit
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
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseMapperMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator\RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseTranslatorMock;

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
    protected $restErpDeliveryNotePageSearchCollectionResponseTransferMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Reader\ErpDeliveryNotePageSearchReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
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

        $this->erpDeliveryNotePageSearchRequestTransferMock = $this
            ->getMockBuilder(ErpDeliveryNotePageSearchRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchClient = $this
            ->getMockBuilder(ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchCollectionResponseMapperMock = $this
            ->getMockBuilder(RestErpDeliveryNotePageSearchCollectionResponseMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErpDeliveryNotePageSearchCollectionResponseTranslatorMock = $this
            ->getMockBuilder(RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface::class)
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

        $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock = $this
            ->getMockBuilder(RestErpDeliveryNotePageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new ErpDeliveryNotePageSearchReader(
            $this->erpDeliveryNotePageSearchClient,
            $this->requestBuilderMock,
            $this->restErpDeliveryNotePageSearchCollectionResponseMapperMock,
            $this->restErpDeliveryNotePageSearchCollectionResponseTranslatorMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFindErpDeliveryNotesByFilterTransfer(): void
    {
        $searchString = 'foo';
        $requestParams = [];
        $searchResult = [];
        $locale = 'de_DE';

        $this->requestBuilderMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->erpDeliveryNotePageSearchRequestTransferMock);

        $this->erpDeliveryNotePageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getSearchString')
            ->willReturn($searchString);

        $this->erpDeliveryNotePageSearchRequestTransferMock->expects(static::atLeastOnce())
            ->method('getRequestParams')
            ->willReturn($requestParams);

        $this->erpDeliveryNotePageSearchClient->expects(static::atLeastOnce())
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

        $this->restErpDeliveryNotePageSearchCollectionResponseMapperMock->expects(static::atLeastOnce())
            ->method('fromSearchResult')
            ->with($searchResult)
            ->willReturn($this->restErpDeliveryNotePageSearchCollectionResponseTransferMock);

        $this->restErpDeliveryNotePageSearchCollectionResponseTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with(
                $this->restErpDeliveryNotePageSearchCollectionResponseTransferMock,
                $locale,
            )->willReturn($this->restErpDeliveryNotePageSearchCollectionResponseTransferMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->reader->findErpDeliveryNotesByFilterTransfer($this->restRequestMock),
        );
    }
}
