<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Updater;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListUpdaterTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestMapperMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Updater\ProductListUpdater
     */
    protected $productListUpdater;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestMapperMock = $this->getMockBuilder(RestProductListUpdateRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(ProductListsRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListUpdater = new ProductListUpdater(
            $this->restResponseBuilderMock,
            $this->restProductListUpdateRequestMapperMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $uuid = 'd6443d3e-f879-492e-85fb-caa8059db684';

        $this->restProductListUpdateRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('setProductList')
            ->with($this->restProductListsAttributesTransferMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn($uuid);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildProductListIdIsMissingRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('updateProductListByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateResponseTransferMock);

        $this->restProductListUpdateResponseTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->productListTransferMock);

        $this->restProductListUpdateResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildErrorRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRestResponse')
            ->with($this->productListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->productListUpdater->update($this->restRequestMock, $this->restProductListsAttributesTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithMissingProductListId(): void
    {
        $this->restProductListUpdateRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('setProductList')
            ->with($this->restProductListsAttributesTransferMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn(null);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildProductListIdIsMissingRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::never())
            ->method('updateProductListByRestProductListUpdateRequest');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildErrorRestResponse');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->productListUpdater->update($this->restRequestMock, $this->restProductListsAttributesTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $uuid = 'd6443d3e-f879-492e-85fb-caa8059db684';

        $this->restProductListUpdateRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('setProductList')
            ->with($this->restProductListsAttributesTransferMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductListId')
            ->willReturn($uuid);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildProductListIdIsMissingRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('updateProductListByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateResponseTransferMock);

        $this->restProductListUpdateResponseTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn(null);

        $this->restProductListUpdateResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->productListUpdater->update($this->restRequestMock, $this->restProductListsAttributesTransferMock),
        );
    }
}
