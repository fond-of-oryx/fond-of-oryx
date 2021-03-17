<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class ShipmentTableRateReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected $zipCodePatternsGeneratorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected $countryFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CountryTransfer
     */
    protected $countryTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTransfer
     */
    protected $shipmentTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\TotalsTransfer
     */
    protected $totalsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AddressTransfer
     */
    protected $addressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    protected $shipmentTableRateTransferMock;

    /**
     * @var int
     */
    protected $idCountry;

    /**
     * @var int
     */
    protected $idStore;

    /**
     * @var string
     */
    protected $iso2Code;

    /**
     * @var string
     */
    protected $storeName;

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string[]
     */
    protected $zipCodePatterns;

    /**
     * @var int
     */
    protected $priceToPay;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected $shipmentTableRateReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->zipCodePatternsGeneratorMock = $this->getMockBuilder(ZipCodePatternsGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ShipmentTableRateRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryFacadeMock = $this->getMockBuilder(ShipmentTableRateToCountryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(ShipmentTableRateToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->totalsTransferMock = $this->getMockBuilder(TotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateTransferMock = $this->getMockBuilder(ShipmentTableRateTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCountry = 1;
        $this->idStore = 1;
        $this->iso2Code = 'DE';
        $this->storeName = 'Store';
        $this->zipCode = '50827';
        $this->zipCodePatterns = ['50827', '5082*', '508*', '50*', '5*', '*'];
        $this->priceToPay = 4995;

        $this->shipmentTableRateReader = new ShipmentTableRateReader(
            $this->zipCodePatternsGeneratorMock,
            $this->repositoryMock,
            $this->countryFacadeMock,
            $this->storeFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetByShipmentAndQuote(): void
    {
        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($this->iso2Code);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($this->storeName);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($this->zipCode);

        $this->countryFacadeMock->expects($this->atLeastOnce())
            ->method('getCountryByIso2Code')
            ->with($this->iso2Code)
            ->willReturn($this->countryTransferMock);

        $this->storeFacadeMock->expects($this->atLeastOnce())
            ->method('getStoreByName')
            ->with($this->storeName)
            ->willReturn($this->storeTransferMock);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->idCountry);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getIdStore')
            ->willReturn($this->idStore);

        $this->totalsTransferMock->expects($this->atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($this->priceToPay);

        $this->zipCodePatternsGeneratorMock->expects($this->atLeastOnce())
            ->method('generateFromZipCode')
            ->with($this->zipCode)
            ->willReturn($this->zipCodePatterns);

        $this->repositoryMock->expects($this->atLeastOnce())
            ->method('getShipmentTableRate')
            ->willReturn($this->shipmentTableRateTransferMock);

        $shipmentTableRateTransfer = $this->shipmentTableRateReader->getByShipmentAndQuote(
            $this->shipmentTransferMock,
            $this->quoteTransferMock
        );

        $this->assertEquals($this->shipmentTableRateTransferMock, $shipmentTableRateTransfer);
    }

    /**
     * @return void
     */
    public function testGetByShipmentAndQuoteWithoutShippingAddress(): void
    {
        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->addressTransferMock->expects($this->never())
            ->method('getIso2Code');

        $this->storeTransferMock->expects($this->never())
            ->method('getName');

        $this->addressTransferMock->expects($this->never())
            ->method('getZipCode');

        $this->countryFacadeMock->expects($this->never())
            ->method('getCountryByIso2Code');

        $this->storeFacadeMock->expects($this->never())
            ->method('getStoreByName');

        $this->countryTransferMock->expects($this->never())
            ->method('getIdCountry');

        $this->storeTransferMock->expects($this->never())
            ->method('getIdStore');

        $this->totalsTransferMock->expects($this->never())
            ->method('getPriceToPay');

        $this->zipCodePatternsGeneratorMock->expects($this->never())
            ->method('generateFromZipCode');

        $this->repositoryMock->expects($this->never())
            ->method('getShipmentTableRate');

        $shipmentTableRateTransfer = $this->shipmentTableRateReader->getByShipmentAndQuote(
            $this->shipmentTransferMock,
            $this->quoteTransferMock
        );

        $this->assertEquals(null, $shipmentTableRateTransfer);
    }

    /**
     * @return void
     */
    public function testGetByShipmentAndQuoteWithoutStoreName(): void
    {
        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($this->iso2Code);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn(null);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($this->zipCode);

        $this->totalsTransferMock->expects($this->atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($this->priceToPay);

        $this->storeFacadeMock->expects($this->never())
            ->method('getStoreByName');

        $this->countryTransferMock->expects($this->never())
            ->method('getIdCountry');

        $this->storeTransferMock->expects($this->never())
            ->method('getIdStore');

        $this->zipCodePatternsGeneratorMock->expects($this->never())
            ->method('generateFromZipCode');

        $this->repositoryMock->expects($this->never())
            ->method('getShipmentTableRate');

        $shipmentTableRateTransfer = $this->shipmentTableRateReader->getByShipmentAndQuote(
            $this->shipmentTransferMock,
            $this->quoteTransferMock
        );

        $this->assertEquals(null, $shipmentTableRateTransfer);
    }

    /**
     * @return void
     */
    public function testGetByShipmentAndQuoteWithoutShipmentTableRateResult(): void
    {
        $this->shipmentTransferMock->expects($this->atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getTotals')
            ->willReturn($this->totalsTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getStore')
            ->willReturn($this->storeTransferMock);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($this->iso2Code);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getName')
            ->willReturn($this->storeName);

        $this->addressTransferMock->expects($this->atLeastOnce())
            ->method('getZipCode')
            ->willReturn($this->zipCode);

        $this->countryFacadeMock->expects($this->atLeastOnce())
            ->method('getCountryByIso2Code')
            ->with($this->iso2Code)
            ->willReturn($this->countryTransferMock);

        $this->storeFacadeMock->expects($this->atLeastOnce())
            ->method('getStoreByName')
            ->with($this->storeName)
            ->willReturn($this->storeTransferMock);

        $this->countryTransferMock->expects($this->atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($this->idCountry);

        $this->storeTransferMock->expects($this->atLeastOnce())
            ->method('getIdStore')
            ->willReturn($this->idStore);

        $this->totalsTransferMock->expects($this->atLeastOnce())
            ->method('getPriceToPay')
            ->willReturn($this->priceToPay);

        $this->zipCodePatternsGeneratorMock->expects($this->atLeastOnce())
            ->method('generateFromZipCode')
            ->with($this->zipCode)
            ->willReturn($this->zipCodePatterns);

        $this->repositoryMock->expects($this->atLeastOnce())
            ->method('getShipmentTableRate')
            ->willReturn(null);

        $shipmentTableRateTransfer = $this->shipmentTableRateReader->getByShipmentAndQuote(
            $this->shipmentTransferMock,
            $this->quoteTransferMock
        );

        $this->assertEquals(null, $shipmentTableRateTransfer);
    }
}
