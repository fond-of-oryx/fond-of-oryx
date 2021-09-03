<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Communication\Plugin\CompanyBusinessUnitExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorFacade;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetCompanyBusinessUnitPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Communication\Plugin\CompanyBusinessUnitExtension\OrderBudgetCompanyBusinessUnitPostSavePlugin
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

        $this->facadeMock = $this->getMockBuilder(OrderBudgetCompanyBusinessUnitConnectorFacade::class)
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
            $this->plugin->postSave($this->companyBusinessUnitTransferMock)
        );
    }
}
