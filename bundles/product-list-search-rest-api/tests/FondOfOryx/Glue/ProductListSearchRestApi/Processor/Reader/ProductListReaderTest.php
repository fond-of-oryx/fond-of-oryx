<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClientInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionMapperMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface|mixed
     */
    protected $metadataMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Reader\ProductListReader
     */
    protected $productListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListCollectionMapperMock = $this->getMockBuilder(ProductListCollectionMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(productListSearchRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataMock = $this->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReader = new ProductListReader(
            $this->productListCollectionMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->productListCollectionMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findProductList')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildProductListSearchRestResponse')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->productListReader->find($this->restRequestMock),
        );
    }
}
