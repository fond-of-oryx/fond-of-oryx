<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeBridge;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class VertigoPriceProductPriceListToProductFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new VertigoPriceProductPriceListToProductFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testHasProductConcrete(): void
    {
        $sku = 'foo-bar-1';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('hasProductConcrete')
            ->with($sku)
            ->willReturn(true);

        static::assertTrue($this->bridge->hasProductConcrete($sku));
    }
}
