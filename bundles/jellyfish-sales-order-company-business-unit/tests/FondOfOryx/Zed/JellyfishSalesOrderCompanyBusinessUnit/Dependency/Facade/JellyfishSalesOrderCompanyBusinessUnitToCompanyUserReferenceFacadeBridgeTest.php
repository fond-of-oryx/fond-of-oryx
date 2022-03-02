<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserReferenceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitByCompanyUserReference(): void
    {
        $companyUserReference = 'FOO--CU-1';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->bridge->getCompanyBusinessUnitByCompanyUserReference($companyUserReference),
        );
    }
}
