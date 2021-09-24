<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\JellyfishSalesOrderGiftCardConnectorDependencyProvider;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
     */
    protected $productCartCodeTypeRestrictionFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCartCodeTypeRestrictionFacadeMock = $this->getMockBuilder(JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new JellyfishSalesOrderGiftCardConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [JellyfishSalesOrderGiftCardConnectorDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION]
            )->willReturnOnConsecutiveCalls(
                $this->productCartCodeTypeRestrictionFacadeMock,
            );

        static::assertInstanceOf(
            JellyfishOrderExpanderInterface::class,
            $this->businessFactory->createJellyfishOrderExpander()
        );
    }
}
