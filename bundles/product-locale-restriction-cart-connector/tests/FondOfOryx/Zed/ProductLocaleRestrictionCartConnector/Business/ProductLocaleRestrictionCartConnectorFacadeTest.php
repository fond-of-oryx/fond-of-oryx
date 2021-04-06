<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartCheckerInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

class ProductLocaleRestrictionCartConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartCheckerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartCheckerMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CartPreCheckResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartPreCheckResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorFacade
     */
    protected $productLocaleRestrictionFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartCheckerMock = $this->getMockBuilder(CartCheckerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacade = new ProductLocaleRestrictionCartConnectorFacade();
        $this->productLocaleRestrictionFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPreCheckCart(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCartChecker')
            ->willReturn($this->cartCheckerMock);

        $this->cartCheckerMock->expects(static::atLeastOnce())
            ->method('preCheck')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->productLocaleRestrictionFacade->preCheckCart($this->cartChangeTransferMock)
        );
    }
}
