<?php

namespace FondOfOryx\Zed\CompanyApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;

class CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    protected $companyBusinessUnitResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitResponseTransferMock = $this->getMockBuilder(CompanyBusinessUnitResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CompanyBusinessUnitApiToCompanyBusinessUnitFacadeBridge(
            $this->companyBusinessUnitFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitById(): void
    {
        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->facadeBridge->getCompanyBusinessUnitById(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitResponseTransferMock,
            $this->facadeBridge->create(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitResponseTransferMock,
            $this->facadeBridge->update(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitResponseTransferMock,
            $this->facadeBridge->delete(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }
}
