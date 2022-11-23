<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface;
use FondOfOryx\Glue\ProductListsRestApi\ProductListsRestApiConfig;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestProductListResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListResponseAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListResponseAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restProductListsAttributesMapperMock = $this->getMockBuilder(RestProductListResponseAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListResponseAttributesTransferMock = $this->getMockBuilder(RestProductListResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restProductListsAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildErrorRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getDetail() === ProductListsRestApiConfig::RESPONSE_DETAIL_PRODUCT_LIST_COULD_NOT_BE_UPDATED
                            && $restErrorMessageTransfer->getCode() === ProductListsRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_COULD_NOT_BE_UPDATED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_UNPROCESSABLE_ENTITY;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildErrorRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildProductListIdIsMissingRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getDetail() === ProductListsRestApiConfig::RESPONSE_DETAIL_PRODUCT_LIST_ID_IS_MISSING
                            && $restErrorMessageTransfer->getCode() === ProductListsRestApiConfig::RESPONSE_CODE_PRODUCT_LIST_ID_IS_MISSING
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildProductListIdIsMissingRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildRestResponse(): void
    {
        $uuid = 'd6443d3e-f879-492e-85fb-caa8059db684';

        $this->restProductListsAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromProductList')
            ->with($this->productListTransferMock)
            ->willReturn($this->restProductListResponseAttributesTransferMock);

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                ProductListsRestApiConfig::RESOURCE_PRODUCT_LISTS,
                $uuid,
                $this->restProductListResponseAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->productListTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildRestResponse($this->productListTransferMock),
        );
    }
}
