<?php

namespace FondOfOryx\Zed\ProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApi;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ProductListApiFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApi|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $productListApiMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Business\ProductListApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Business\ProductListApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this
            ->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this
            ->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListApiMock = $this
            ->getMockBuilder(ProductListApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(ProductListApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ProductListApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindProductLists(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListApi')
            ->willReturn($this->productListApiMock);

        $this->productListApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->facade->findProductLists($this->apiRequestTransferMock),
        );
    }
}
