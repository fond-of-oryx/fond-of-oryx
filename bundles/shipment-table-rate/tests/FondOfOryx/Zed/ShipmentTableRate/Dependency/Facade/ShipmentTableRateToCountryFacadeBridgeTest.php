<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CountryTransfer;
use Spryker\Zed\Country\Business\CountryFacadeInterface;

class ShipmentTableRateToCountryFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Country\Business\CountryFacadeInterface
     */
    protected $countryFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CountryTransfer
     */
    protected $countryTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeBridge
     */
    protected $shipmentTableRateToCountryFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->countryFacadeMock = $this->getMockBuilder(CountryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateToCountryFacadeBridge = new ShipmentTableRateToCountryFacadeBridge(
            $this->countryFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCountryByIso2Code(): void
    {
        $iso2Code = 'EN';

        $this->countryFacadeMock->expects($this->atLeastOnce())
            ->method('getCountryByIso2Code')
            ->with($iso2Code)
            ->willReturn($this->countryTransferMock);

        $countryTransfer = $this->shipmentTableRateToCountryFacadeBridge->getCountryByIso2Code($iso2Code);

        $this->assertEquals($this->countryTransferMock, $countryTransfer);
    }
}
