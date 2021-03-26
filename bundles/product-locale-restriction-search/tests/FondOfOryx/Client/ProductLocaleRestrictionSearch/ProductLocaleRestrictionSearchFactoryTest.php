<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface;
use Spryker\Client\Kernel\Container;

class ProductLocaleRestrictionSearchFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchFactory
     */
    protected $productLocaleRestrictionSearchFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionSearchToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionSearchFactory = new ProductLocaleRestrictionSearchFactory();
        $this->productLocaleRestrictionSearchFactory->setContainer($this->containerMock);
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
            ->with(ProductLocaleRestrictionSearchDependencyProvider::CLIENT_LOCALE)
            ->willReturn($this->localeClientMock);

        static::assertEquals(
            $this->localeClientMock,
            $this->productLocaleRestrictionSearchFactory->getLocaleClient()
        );
    }
}
