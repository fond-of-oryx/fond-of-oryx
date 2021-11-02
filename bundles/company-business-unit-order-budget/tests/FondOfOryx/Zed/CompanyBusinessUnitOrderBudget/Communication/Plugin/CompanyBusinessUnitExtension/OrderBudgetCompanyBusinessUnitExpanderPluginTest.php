<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacade;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetCompanyBusinessUnitExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension\OrderBudgetCompanyBusinessUnitExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OrderBudgetCompanyBusinessUnitExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->plugin->expand($this->companyBusinessUnitTransferMock),
        );
    }
}
