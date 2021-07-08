<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class GiftCardProductConnectorToProductFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeBridge
     */
    protected $giftCardProductConnectorToProductFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productFacadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorToProductFacadeBridge = new GiftCardProductConnectorToProductFacadeBridge(
            $this->productFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFindProductAbstractById(): void
    {
        $idProductAbstract = 1;

        $this->productFacadeMock->expects($this->atLeastOnce())
            ->method('findProductAbstractById')
            ->with($idProductAbstract)
            ->willReturn($this->productAbstractTransferMock);

        $productAbstractTransfer = $this->giftCardProductConnectorToProductFacadeBridge->findProductAbstractById($idProductAbstract);

        $this->assertInstanceOf(
            ProductAbstractTransfer::class,
            $productAbstractTransfer
        );

        $this->assertEquals($this->productAbstractTransferMock, $productAbstractTransfer);
    }
}
