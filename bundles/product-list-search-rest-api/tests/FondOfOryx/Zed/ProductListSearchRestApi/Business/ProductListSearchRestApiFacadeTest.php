<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReaderInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductListSearchRestApiFacadeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiBusinessFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ProductListSearchRestApiBusinessFactory|MockObject $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ProductListReaderInterface|MockObject $productListReaderMock;

    /**
     * @var (\Generated\Shared\Transfer\ProductListCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ProductListCollectionTransfer|MockObject $productListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiFacade
     */
    protected ProductListSearchRestApiFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductListSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ProductListSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindProductList(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListReader')
            ->willReturn($this->productListReaderMock);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('findProductList')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        static::assertEquals(
            $this->productListCollectionTransferMock,
            $this->facade->findProductList($this->productListCollectionTransferMock),
        );
    }
}
