<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter\JellyfishOrderItemsSplitterInterface;
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
        $self = $this;

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case JellyfishSalesOrderGiftCardConnectorDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION:
                        return $self->productCartCodeTypeRestrictionFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            JellyfishOrderExpanderInterface::class,
            $this->businessFactory->createJellyfishOrderExpander(),
        );
    }

    /**
     * @return void
     */
    public function testCreateJellyfishOrderItemsSplitter(): void
    {
        static::assertInstanceOf(
            JellyfishOrderItemsSplitterInterface::class,
            $this->businessFactory->createJellyfishOrderItemsSplitter(),
        );
    }
}
