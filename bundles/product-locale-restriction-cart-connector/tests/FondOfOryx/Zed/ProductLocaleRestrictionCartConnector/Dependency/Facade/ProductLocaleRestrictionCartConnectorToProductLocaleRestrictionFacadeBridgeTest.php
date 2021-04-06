<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;

class ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge
     */
    protected $productLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge = new ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge(
            $this->productLocaleRestrictionFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedLocalesByProductConcreteSkus(): void
    {
        $productConcreteSkus = ['FOO-1', 'FOO-2'];
        $blacklistedLocales = ['FOO-1' => ['de_DE', 'en_US']];

         $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductConcreteSkus')
             ->with($productConcreteSkus)
             ->willReturn($blacklistedLocales);

         static::assertEquals(
             $blacklistedLocales,
             $this->productLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge
                 ->getBlacklistedLocalesByProductConcreteSkus($productConcreteSkus)
         );
    }
}
