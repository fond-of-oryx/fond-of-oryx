<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface;

class JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge(
            $this->facadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedCartCodeTypesByProductConcreteSkus(): void
    {
        $productConcreteSkus = ['sku'];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($productConcreteSkus)
            ->willReturn([]);

        static::assertIsArray(
            $this->facadeBridge->getBlacklistedCartCodeTypesByProductConcreteSkus($productConcreteSkus)
        );
    }
}
