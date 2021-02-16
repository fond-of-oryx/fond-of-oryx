<?php

namespace FondOfOryx\Glue\ErpOrder\Model\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyUserFacadeBridge;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacade;

class ErpOrderToCompanyUserFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyUserFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(CompanyUserFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this
            ->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ErpOrderToCompanyUserFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUserById(): void
    {
        $this->facadeMock->expects($this->once())->method('getCompanyUserById')->willReturn($this->companyUserTransferMock);

        $result = $this->facade->getCompanyUserById(1);

        $this->assertInstanceOf(CompanyUserTransfer::class, $result);
    }
}
