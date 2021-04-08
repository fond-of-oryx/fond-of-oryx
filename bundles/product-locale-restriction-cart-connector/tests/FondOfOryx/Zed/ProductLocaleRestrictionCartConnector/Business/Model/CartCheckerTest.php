<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Laminas\Stdlib\ArrayObject;

class CartCheckerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartChecker
     */
    protected $cartChecker;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->cartChecker = new CartChecker($this->productLocaleRestrictionFacadeMock);
    }

    /**
     * @return void
     */
    public function testPreCheckWithoutCurrentLocales(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn(null);

        $cartPreCheckResponseTransfer = $this->cartChecker->preCheck($this->cartChangeTransferMock);

        static::assertTrue($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(0, $cartPreCheckResponseTransfer->getMessages());
    }

    /**
     * @return void
     */
    public function testPreCheckWithoutBlacklistedLocales(): void
    {
        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn('de_DE');

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-1');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-2');

        $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductConcreteSkus')
            ->with(static::callback(static function (array $productAbstractIds) {
                return $productAbstractIds[0] === 'FOO-1' && $productAbstractIds[1] === 'FOO-2';
            }))->willReturn([]);

        $cartPreCheckResponseTransfer = $this->cartChecker->preCheck($this->cartChangeTransferMock);

        static::assertTrue($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(0, $cartPreCheckResponseTransfer->getMessages());
    }

    /**
     * @return void
     */
    public function testPreCheckWithRestrictedItems(): void
    {
        $currentLocale = 'de_DE';

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn('de_DE');

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-1');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-2');

        $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductConcreteSkus')
            ->with(
                static::callback(
                    static function (array $productAbstractIds) {
                        return $productAbstractIds[0] === 'FOO-1' && $productAbstractIds[1] === 'FOO-2';
                    }
                )
            )->willReturn(['FOO-1' => [$currentLocale]]);

        $cartPreCheckResponseTransfer = $this->cartChecker->preCheck($this->cartChangeTransferMock);

        static::assertFalse($cartPreCheckResponseTransfer->getIsSuccess());
        static::assertCount(1, $cartPreCheckResponseTransfer->getMessages());
    }
}
