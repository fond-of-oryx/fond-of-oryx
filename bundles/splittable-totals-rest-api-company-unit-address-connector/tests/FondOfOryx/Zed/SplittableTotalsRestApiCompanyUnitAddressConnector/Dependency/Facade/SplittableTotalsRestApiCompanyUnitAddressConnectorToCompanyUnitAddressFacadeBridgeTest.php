<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridgeTest extends Unit
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
     * @var \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge
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

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge(
            $this->companyUnitAddressFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyBusinessUnitAddressByUuid(): void
    {
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        static::assertEquals(
            $this->companyUnitAddressResponseTransferMock,
            $this->facadeBridge->findCompanyBusinessUnitAddressByUuid($this->companyUnitAddressTransferMock)
        );
    }
}
