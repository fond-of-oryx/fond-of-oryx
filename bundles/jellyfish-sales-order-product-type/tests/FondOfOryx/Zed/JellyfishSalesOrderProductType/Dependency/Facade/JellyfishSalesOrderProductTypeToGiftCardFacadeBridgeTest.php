<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface;

class JellyfishSalesOrderProductTypeToGiftCardFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(GiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new JellyfishSalesOrderProductTypeToGiftCardFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testIsGiftCardOrderItem(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isGiftCardOrderItem')
            ->with(1)
            ->willReturn(true);

        static::assertEquals(
            true,
            $this->facadeBridge->isGiftCardOrderItem(1),
        );
    }
}
