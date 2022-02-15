<?php

namespace FondOfOryx\Glue\ErpDeliveryNote\Model\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCountryFacadeBridge;
use FondOfSpryker\Zed\Country\Business\CountryFacade;
use Generated\Shared\Transfer\CountryTransfer;

class ErpDeliveryNoteToCountryFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\Country\Business\CountryFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CountryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $countryTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCountryFacadeBridge
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(CountryFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this
            ->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ErpDeliveryNoteToCountryFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCountryByIdCountry(): void
    {
        $this->facadeMock->expects($this->once())->method('getCountryByIdCountry')->willReturn($this->countryTransferMock);

        $result = $this->facade->getCountryByIdCountry(1);

        $this->assertInstanceOf(CountryTransfer::class, $result);
    }
}
