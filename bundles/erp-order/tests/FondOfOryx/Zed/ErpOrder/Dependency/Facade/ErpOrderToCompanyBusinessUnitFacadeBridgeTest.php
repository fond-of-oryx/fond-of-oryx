<?php

namespace FondOfOryx\Glue\ErpOrder\Model\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeBridge;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade;

class ErpOrderToCompanyBusinessUnitFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(CompanyBusinessUnitFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this
            ->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ErpOrderToCompanyBusinessUnitFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitById(): void
    {
        $this->facadeMock->expects($this->once())->method('getCompanyBusinessUnitById')->willReturn($this->companyBusinessUnitTransferMock);

        $result = $this->facade->getCompanyBusinessUnitById($this->companyBusinessUnitTransferMock);

        $this->assertInstanceOf(CompanyBusinessUnitTransfer::class, $result);
    }
}
