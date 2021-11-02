<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface;

class ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCountryRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge
     */
    protected $productCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productCountryRestrictionFacadeMock = $this->getMockBuilder(ProductCountryRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge = new ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge(
            $this->productCountryRestrictionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedCountriesByProductConcreteSkus(): void
    {
        $productConcreteSkus = ['FOO-1', 'FOO-2'];
        $blacklistedCountries = ['FOO-1' => ['DE', 'UK']];

        $this->productCountryRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountriesByProductConcreteSkus')
            ->with($productConcreteSkus)
            ->willReturn($blacklistedCountries);

        static::assertEquals(
            $blacklistedCountries,
            $this->productCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge
                ->getBlacklistedCountriesByProductConcreteSkus($productConcreteSkus),
        );
    }
}
