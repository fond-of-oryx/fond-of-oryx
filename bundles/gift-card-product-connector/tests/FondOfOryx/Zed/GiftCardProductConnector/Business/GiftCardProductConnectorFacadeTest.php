<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;

class GiftCardProductConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorBusinessFactory
     */
    protected $giftCardProductConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface
     */
    protected $giftCardProductAbstractConfigurationWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface
     */
    protected $giftCardProductConfigurationWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductConcreteTransferTransfer
     */
    protected $productConcreteTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCardProductConnectorFacadeInterface
     */
    protected $giftCardProductConnectorFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->giftCardProductConnectorBusinessFactoryMock = $this->getMockBuilder(GiftCardProductConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductAbstractConfigurationWriterMock = $this->getMockBuilder(GiftCardProductAbstractConfigurationWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConfigurationWriterMock = $this->getMockBuilder(GiftCardProductConfigurationWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productConcreteTransferMock = $this->getMockBuilder(ProductConcreteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardProductConnectorFacade = new GiftCardProductConnectorFacade();
        $this->giftCardProductConnectorFacade->setFactory($this->giftCardProductConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductAbstractConfiguration(): void
    {
        $this->giftCardProductConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createGiftCardProductAbstractConfigurationWriter')
            ->willReturn($this->giftCardProductAbstractConfigurationWriterMock);

        $this->giftCardProductAbstractConfigurationWriterMock->expects($this->atLeastOnce())
            ->method('saveGiftCardProductAbstractConfiguration')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        $productAbstractTransferMock = $this->giftCardProductConnectorFacade->saveGiftCardProductAbstractConfiguration(
            $this->productAbstractTransferMock,
        );

        $this->assertInstanceOf(ProductAbstractTransfer::class, $productAbstractTransferMock);
        $this->assertEquals($this->productAbstractTransferMock, $productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testSaveGiftCardProductConfiguration(): void
    {
        $this->giftCardProductConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createGiftCardProductConfigurationWriter')
            ->willReturn($this->giftCardProductConfigurationWriterMock);

        $this->giftCardProductConfigurationWriterMock->expects($this->atLeastOnce())
            ->method('saveGiftCardProductConfiguration')
            ->with($this->productConcreteTransferMock)
            ->willReturn($this->productConcreteTransferMock);

        $productConcreteTransferMock = $this->giftCardProductConnectorFacade->saveGiftCardProductConfiguration(
            $this->productConcreteTransferMock,
        );

        $this->assertInstanceOf(ProductConcreteTransfer::class, $productConcreteTransferMock);
        $this->assertEquals($this->productConcreteTransferMock, $productConcreteTransferMock);
    }
}
