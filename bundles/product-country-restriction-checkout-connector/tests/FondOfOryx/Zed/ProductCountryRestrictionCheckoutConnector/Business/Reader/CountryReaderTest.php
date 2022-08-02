<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge;
use Generated\Shared\Transfer\BlacklistedCountryTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CountryReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\Reader\BlacklistedCountryReaderInterface
     */
    protected $countryReader;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCountryRestrictionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\BlacklistedCountryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $blacklistedCountryTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productCountryRestrictionFacadeMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedCountryTransferMock = $this->getMockBuilder(BlacklistedCountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryReader = new BlacklistedCountryReader($this->productCountryRestrictionFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetByQuote(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-1');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-2');

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-3');

        $this->productCountryRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountriesByProductConcreteSkus')
            ->with(['FOO-1', 'FOO-2', 'FOO-3'])
            ->willReturn([
                'FOO-1' => ['HR', 'LT', 'SE'],
                'FOO-2' => ['HR', 'CZ', 'SE'],
                'FOO-3' => ['HR', 'CZ', 'HU'],
            ]);

        $blacklistedCountryCollectionTransfer = $this->countryReader->getByQuote($this->quoteTransferMock);

        static::assertCount(5, $blacklistedCountryCollectionTransfer->getBlacklistedCountries());
    }

    /**
     * @return void
     */
    public function testGetGroupedByQuote(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-1');

        $this->itemTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-2');

        $this->itemTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn('FOO-3');

        $this->productCountryRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountriesByProductConcreteSkus')
            ->with(['FOO-1', 'FOO-2', 'FOO-3'])
            ->willReturn([
                'FOO-1' => ['HR', 'LT', 'SE'],
                'FOO-2' => ['HR', 'CZ', 'SE'],
                'FOO-3' => ['HR', 'CZ', 'HU'],
            ]);

        $result = $this->countryReader->getGroupedByQuote($this->quoteTransferMock);

        static::assertCount(3, $result);
        static::assertCount(3, $result['FOO-1']);
        static::assertCount(3, $result['FOO-2']);
        static::assertCount(3, $result['FOO-3']);
    }
}
