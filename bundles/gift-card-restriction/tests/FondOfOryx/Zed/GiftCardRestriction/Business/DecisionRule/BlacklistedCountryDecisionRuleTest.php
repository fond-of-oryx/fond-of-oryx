<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class BlacklistedCountryDecisionRuleTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CountryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $countryTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule
     */
    protected $decisionRule;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GiftCardRestrictionConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->decisionRule = new BlacklistedCountryDecisionRule($this->configMock);
    }

    /**
     * @return void
     */
    public function testIsSatisfiedBy(): void
    {
        $blacklistedCountries = ['AT', 'DE'];
        $currentCountry = 'CH';

        $this->configMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountries')
            ->willReturn($blacklistedCountries);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        foreach ($this->itemTransferMocks as $index => $itemTransferMock) {
            $itemTransferMock->expects(static::atLeastOnce())
                ->method('getShipment')
                ->willReturn($index === 1 ? $this->shipmentTransferMock : null);
        }

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($currentCountry);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->countryTransferMock);

        $this->countryTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($currentCountry);

        static::assertTrue($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsSatisfiedByWithBlacklistedCountry(): void
    {
        $blacklistedCountries = ['AT', 'DE'];
        $currentCountry = 'DE';

        $this->configMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountries')
            ->willReturn($blacklistedCountries);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        foreach ($this->itemTransferMocks as $index => $itemTransferMock) {
            $itemTransferMock->expects(static::atLeastOnce())
                ->method('getShipment')
                ->willReturn($index === 1 ? $this->shipmentTransferMock : null);
        }

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($currentCountry);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->countryTransferMock);

        $this->countryTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($currentCountry);

        static::assertFalse($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsSatisfiedByWithoutBlacklistedCountries(): void
    {
        $blacklistedCountries = [];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountries')
            ->willReturn($blacklistedCountries);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        static::assertTrue($this->decisionRule->isSatisfiedBy($this->giftCardTransferMock, $this->quoteTransferMock));
    }
}
