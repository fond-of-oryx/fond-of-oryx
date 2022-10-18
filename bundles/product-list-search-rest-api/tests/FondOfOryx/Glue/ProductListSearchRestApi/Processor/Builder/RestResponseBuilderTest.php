<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestProductListSearchAttributesTransfer;
use Generated\Shared\Transfer\RestProductListSearchPaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\RestProductListSearchAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|mixed
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListSearchPaginationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restProductListSearchAttributesMapperMock = $this->getMockBuilder(RestProductListSearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchAttributesTransferMock = $this->getMockBuilder(RestProductListSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchPaginationTransferMock = $this->getMockBuilder(RestProductListSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListSearchAttributesTranslatorMock = $this->getMockBuilder(RestProductListSearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restProductListSearchAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildProductListSearchRestResponse(): void
    {
        $numFound = 10;

        $this->restProductListSearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromProductListCollection')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->restProductListSearchAttributesTransferMock);

        $this->restProductListSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restProductListSearchPaginationTransferMock);

        $this->restProductListSearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListSearchRestApiConfig::RESOURCE_PRODUCT_LIST_SEARCH,
                null,
                $this->restProductListSearchAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildProductListSearchRestResponse(
                $this->productListCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildUseIsNotSpecifiedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === ProductListSearchRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === ProductListSearchRestApiConfig::ERROR_MESSAGE_PRODUCT_LIST_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse(),
        );
    }
}
