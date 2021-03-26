<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;

class ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge
     */
    protected $productLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge = new ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge(
            $this->productLocaleRestrictionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedLocalesByProductAbstractIds(): void
    {
        $productAbstractIds = [1, 2, 3];
        $blacklistedLocales = [1 => ['de_DE', 'en_US']];

        $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductAbstractIds')
            ->with($productAbstractIds)
            ->willReturn($blacklistedLocales);

        static::assertEquals(
            $blacklistedLocales,
            $this->productLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge
                ->getBlacklistedLocalesByProductAbstractIds($productAbstractIds)
        );
    }
}
