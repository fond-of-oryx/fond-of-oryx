<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface;
use Spryker\Client\Kernel\Container;

class ProductLocaleRestrictionCartConnectorFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorFactory
     */
    protected $productLocaleRestrictionCartConnectorFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionCartConnectorFactory = new ProductLocaleRestrictionCartConnectorFactory();
        $this->productLocaleRestrictionCartConnectorFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetLocaleClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductLocaleRestrictionCartConnectorDependencyProvider::CLIENT_LOCALE)
            ->willReturn($this->localeClientMock);

        static::assertEquals(
            $this->localeClientMock,
            $this->productLocaleRestrictionCartConnectorFactory->getLocaleClient()
        );
    }
}
