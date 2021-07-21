<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCartCodeTypeDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCartCodeTypeRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GiftCardRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCartCodeTypeRestrictionFacadeMock = $this->getMockBuilder(GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GiftCardRestrictionBusinessFactory();
        $this->factory->setConfig($this->configMock);
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateBlacklistedCountryDecisionRule(): void
    {
        static::assertInstanceOf(
            BlacklistedCountryDecisionRule::class,
            $this->factory->createBlacklistedCountryDecisionRule()
        );
    }

    /**
     * @return void
     */
    public function testCreateVoucherDiscountDecisionRule(): void
    {
        static::assertInstanceOf(
            VoucherDiscountDecisionRule::class,
            $this->factory->createVoucherDiscountDecisionRule()
        );
    }

    /**
     * @return void
     */
    public function testBlacklistedCartCodeTypeDecisionRule(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(GiftCardRestrictionDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(GiftCardRestrictionDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION)
            ->willReturn($this->productCartCodeTypeRestrictionFacadeMock);

        static::assertInstanceOf(
            BlacklistedCartCodeTypeDecisionRule::class,
            $this->factory->createBlacklistedCartCodeTypeDecisionRule()
        );
    }
}
