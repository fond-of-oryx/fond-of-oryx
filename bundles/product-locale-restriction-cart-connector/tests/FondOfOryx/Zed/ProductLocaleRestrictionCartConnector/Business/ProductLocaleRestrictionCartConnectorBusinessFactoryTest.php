<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\Model\CartChecker;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionCartConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Business\ProductLocaleRestrictionCartConnectorBusinessFactory
     */
    protected $productLocaleRestrictionCartConnectorBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionCartConnectorBusinessFactory = new ProductLocaleRestrictionCartConnectorBusinessFactory();
        $this->productLocaleRestrictionCartConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCartChecker(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductLocaleRestrictionCartConnectorDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION)
            ->willReturn($this->productLocaleRestrictionFacadeMock);

        static::assertInstanceOf(
            CartChecker::class,
            $this->productLocaleRestrictionCartConnectorBusinessFactory->createCartChecker()
        );
    }
}
