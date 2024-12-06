<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorFacade;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ProductListRestrictedItemsPreCheckPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartChangeTransfer|MockObject $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartPreCheckResponseTransfer|MockObject $cartPreCheckResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorFacade
     */
    protected MockObject|BusinessOnBehalfProductListConnectorFacade $facadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Communication\Plugin\CartExtension\ProductListRestrictedItemsPreCheckPlugin
     */
    protected ProductListRestrictedItemsPreCheckPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductListRestrictedItemsPreCheckPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateItemAddProductListRestrictions')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->plugin->check($this->cartChangeTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testTerminateOnFailure(): void
    {
        static::assertTrue($this->plugin->terminateOnFailure());
    }
}
