<?php

namespace FondOfOryx\Glue\ErpOrder\Model\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeBridge;
use FondOfSpryker\Zed\Country\Business\CountryFacade;
use Generated\Shared\Transfer\CountryTransfer;

class ErpOrderToCountryFacadeBridgeTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeBridge
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

        $this->facade = new ErpOrderToCountryFacadeBridge($this->facadeMock);
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
