<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Model\QuoteValidator;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductCountryRestrictionCheckoutConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCountryRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorBusinessFactory
     */
    protected $productCountryRestrictionCheckoutConnectorBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionFacadeMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionCheckoutConnectorBusinessFactory = new ProductCountryRestrictionCheckoutConnectorBusinessFactory();
        $this->productCountryRestrictionCheckoutConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductCountryRestrictionCheckoutConnectorDependencyProvider::FACADE_PRODUCT_COUNTRY_RESTRICTION)
            ->willReturn($this->productCountryRestrictionFacadeMock);

        static::assertInstanceOf(
            QuoteValidator::class,
            $this->productCountryRestrictionCheckoutConnectorBusinessFactory->createQuoteValidator(),
        );
    }
}
