<?php

namespace FondOfOryx\Client\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductListsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(ProductListsRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new ProductListsRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testUpdateProductListByRestProductListUpdateRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListsRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('updateProductListByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateResponseTransferMock);

        static::assertEquals(
            $this->restProductListUpdateResponseTransferMock,
            $this->client->updateProductListByRestProductListUpdateRequest($this->restProductListUpdateRequestTransferMock),
        );
    }
}
