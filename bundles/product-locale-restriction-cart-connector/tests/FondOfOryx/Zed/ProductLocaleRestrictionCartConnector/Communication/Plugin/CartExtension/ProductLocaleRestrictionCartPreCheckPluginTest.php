<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorFacade;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

class ProductLocaleRestrictionCartPreCheckPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartPreCheckResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Communication\Plugin\CartExtension\ProductLocaleRestrictionCartPreCheckPlugin
     */
    protected $productLocaleRestrictionCartPreCheckPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionCartPreCheckPlugin = new ProductLocaleRestrictionCartPreCheckPlugin();
        $this->productLocaleRestrictionCartPreCheckPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testTerminateOnFailure(): void
    {
        static::assertTrue($this->productLocaleRestrictionCartPreCheckPlugin->terminateOnFailure());
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('preCheckCart')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->productLocaleRestrictionCartPreCheckPlugin->check($this->cartChangeTransferMock),
        );
    }
}
