<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig;

class GiftCardRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

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

        $this->factory = new GiftCardRestrictionBusinessFactory();
        $this->factory->setConfig($this->configMock);
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
}
