<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class BlacklistedCountryDecisionRulePluginTest extends Unit
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
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
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
     * @var \FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard\BlacklistedCountryDecisionRulePlugin
     */
    protected $plugin;

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

        $this->plugin = new class ($this->configMock) extends BlacklistedCountryDecisionRulePlugin {
            /**
             * @var \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            protected $giftCardRestrictionConfig;

            /**
             * @param \Spryker\Zed\Kernel\AbstractBundleConfig $giftCardRestrictionConfig
             */
            public function __construct(AbstractBundleConfig $giftCardRestrictionConfig)
            {
                $this->giftCardRestrictionConfig = $giftCardRestrictionConfig;
            }

            /**
             * @return \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            public function getConfig(): AbstractBundleConfig
            {
                return $this->giftCardRestrictionConfig;
            }
        };
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
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

        static::assertTrue($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithBlacklistedCountry(): void
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

        static::assertFalse($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithoutBlacklistedCountries(): void
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

        static::assertTrue($this->plugin->isApplicable($this->giftCardTransferMock, $this->quoteTransferMock));
    }
}
