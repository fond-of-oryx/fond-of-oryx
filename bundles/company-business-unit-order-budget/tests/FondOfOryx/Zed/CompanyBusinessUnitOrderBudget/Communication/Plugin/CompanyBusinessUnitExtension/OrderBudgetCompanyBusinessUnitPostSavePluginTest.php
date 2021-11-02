<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacade;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetCompanyBusinessUnitPostSavePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension\OrderBudgetCompanyBusinessUnitPostSavePlugin
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

        $this->plugin = new OrderBudgetCompanyBusinessUnitPostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetForCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->plugin->postSave($this->companyBusinessUnitTransferMock),
        );
    }
}
