<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Dependency\Client\ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Zed\ProductCountryRestrictionCheckoutConnectorStub;
use Spryker\Client\Kernel\Container;

class ProductCountryRestrictionCheckoutConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorFactory
     */
    protected $productCountryRestrictionCheckoutConnectorFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorFactory = new ProductCountryRestrictionCheckoutConnectorFactory();
        $this->productCountryRestrictionCheckoutConnectorFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductCountryRestrictionCheckoutConnectorZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductCountryRestrictionCheckoutConnectorDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            ProductCountryRestrictionCheckoutConnectorStub::class,
            $this->productCountryRestrictionCheckoutConnectorFactory
                ->createProductCountryRestrictionCheckoutConnectorZedStub()
        );
    }
}
