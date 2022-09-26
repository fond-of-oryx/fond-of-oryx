<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdaterInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdaterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListUpdaterMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductListsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListUpdaterMock = $this->getMockBuilder(ProductListUpdaterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ProductListsRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testUpdateProductListByRestProductListUpdateRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListUpdater')
            ->willReturn($this->productListUpdaterMock);

        $this->productListUpdaterMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateResponseTransferMock);

        static::assertEquals(
            $this->restProductListUpdateResponseTransferMock,
            $this->facade->updateProductListByRestProductListUpdateRequest(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
