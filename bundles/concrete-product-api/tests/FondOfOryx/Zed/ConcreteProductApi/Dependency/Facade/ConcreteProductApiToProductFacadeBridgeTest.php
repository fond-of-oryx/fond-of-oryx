<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class ConcreteProductApiToProductFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeBridge
     */
    protected $concreteProductApiToProductFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacadeInterfaceMock;

    /**
     * @var int
     */
    protected $idProduct;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected $productConcreteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productFacadeInterfaceMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProduct = 1;

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->concreteProductApiToProductFacadeBridge = new ConcreteProductApiToProductFacadeBridge(
            $this->productFacadeInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testFindProductConcreteById(): void
    {
        $this->productFacadeInterfaceMock->expects(static::atLeastOnce())
            ->method('findProductConcreteById')
            ->with($this->idProduct)
            ->willReturn($this->productConcreteTransferMock);

        static::assertEquals(
            $this->productConcreteTransferMock,
            $this->concreteProductApiToProductFacadeBridge->findProductConcreteById($this->idProduct),
        );
    }
}
