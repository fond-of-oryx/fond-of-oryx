<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge(
            $this->companyUnitAddressFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressById(): void
    {
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $this->companyUnitAddressTransferMock,
            $this->facadeBridge->getCompanyUnitAddressById($this->companyUnitAddressTransferMock)
        );
    }
}
