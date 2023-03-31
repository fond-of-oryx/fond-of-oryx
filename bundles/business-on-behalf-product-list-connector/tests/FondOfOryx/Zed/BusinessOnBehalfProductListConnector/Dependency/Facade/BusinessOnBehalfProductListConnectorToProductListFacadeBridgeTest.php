<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\ProductList\Business\ProductListFacadeInterface;

class BusinessOnBehalfProductListConnectorToProductListFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\ProductList\Business\ProductListFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|ProductListFacadeInterface $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QuoteTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CartChangeTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartChangeTransfer|MockObject $cartChangeTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\CartPreCheckResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CartPreCheckResponseTransfer|MockObject $cartPreCheckResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeBridge
     */
    protected BusinessOnBehalfProductListConnectorToProductListFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartPreCheckResponseTransferMock = $this->getMockBuilder(CartPreCheckResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new BusinessOnBehalfProductListConnectorToProductListFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testValidateItemAddProductListRestrictions(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validateItemAddProductListRestrictions')
            ->with($this->cartChangeTransferMock)
            ->willReturn($this->cartPreCheckResponseTransferMock);

        static::assertEquals(
            $this->cartPreCheckResponseTransferMock,
            $this->bridge->validateItemAddProductListRestrictions($this->cartChangeTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFilterRestrictedItems(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('filterRestrictedItems')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->bridge->filterRestrictedItems($this->quoteTransferMock),
        );
    }
}
