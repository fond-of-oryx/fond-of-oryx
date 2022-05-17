<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class CompanyUnitAddressApiToCompanyUnitAddressFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeBridge
     */
    protected $companyUnitAddressFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeBridge = new CompanyUnitAddressApiToCompanyUnitAddressFacadeBridge(
            $this->companyUnitAddressFacadeMock,
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
            $this->companyUnitAddressFacadeBridge->getCompanyUnitAddressById(
                $this->companyUnitAddressTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        static::assertEquals(
            $this->companyUnitAddressResponseTransferMock,
            $this->companyUnitAddressFacadeBridge->create(
                $this->companyUnitAddressTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        static::assertEquals(
            $this->companyUnitAddressResponseTransferMock,
            $this->companyUnitAddressFacadeBridge->update(
                $this->companyUnitAddressTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeBridge->delete($this->companyUnitAddressTransferMock);
    }
}
