<?php

namespace FondOfOryx\Glue\ErpInvoice\Model\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeBridge;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacade;

class ErpInvoiceToCompanyBusinessUnitFacadeBridgeTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface
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

        $this->facade = new ErpInvoiceToCompanyBusinessUnitFacadeBridge($this->facadeMock);
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
