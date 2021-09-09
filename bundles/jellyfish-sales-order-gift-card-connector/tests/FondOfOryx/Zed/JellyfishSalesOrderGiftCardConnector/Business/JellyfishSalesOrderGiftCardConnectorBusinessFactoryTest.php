<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderGiftCardConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\JellyfishSalesOrderGiftCardConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new JellyfishSalesOrderGiftCardConnectorBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderItemExpander(): void
    {
        static::assertInstanceOf(
            JellyfishOrderItemExpanderInterface::class,
            $this->businessFactory->createJellyfishOrderItemExpander()
        );
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderExpander(): void
    {
        static::assertInstanceOf(
            JellyfishOrderExpanderInterface::class,
            $this->businessFactory->createJellyfishOrderExpander()
        );
    }
}
