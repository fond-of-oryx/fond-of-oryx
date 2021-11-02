<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\JellyfishSalesOrderProductTypeDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderProductTypeBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\JellyfishSalesOrderProductTypeBusinessFactory
     */
    protected $businessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
     */
    protected $giftCardFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardFacadeMock = $this->getMockBuilder(JellyfishSalesOrderProductTypeToGiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new JellyfishSalesOrderProductTypeBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderItemExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(JellyfishSalesOrderProductTypeDependencyProvider::FACADE_GIFT_CARD)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(JellyfishSalesOrderProductTypeDependencyProvider::FACADE_GIFT_CARD)
            ->willReturn($this->giftCardFacadeMock);

        static::assertInstanceOf(
            JellyfishOrderItemExpanderInterface::class,
            $this->businessFactory->createJellyfishOrderItemExpander(),
        );
    }
}
